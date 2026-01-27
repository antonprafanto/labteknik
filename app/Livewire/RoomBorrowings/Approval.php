<?php

namespace App\Livewire\RoomBorrowings;

use App\Models\RoomBorrowing;
use App\Mail\RoomBorrowingStatusUpdated;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Approval extends Component
{
    use WithPagination;

    public $search = '';
    public $showApprovalModal = false;
    public $showRejectionModal = false;
    public $selectedBorrowing = null;
    public $rejectionReason = '';

    public function confirmApprove($id)
    {
        $this->selectedBorrowing = RoomBorrowing::with(['room', 'user'])->find($id);
        
        if ($this->selectedBorrowing && $this->selectedBorrowing->status === 'pending') {
            $this->showApprovalModal = true;
        }
    }

    public function approve()
    {
        if (!$this->selectedBorrowing) {
            return;
        }

        $this->selectedBorrowing->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        // Send email notification
        try {
            Mail::to($this->selectedBorrowing->user->email)->send(
                new RoomBorrowingStatusUpdated($this->selectedBorrowing)
            );
        } catch (\Exception $e) {
            // Log error but don't fail the approval
            \Log::error('Failed to send approval email: ' . $e->getMessage());
        }

        session()->flash('message', 'Peminjaman ruangan telah disetujui.');
        
        $this->closeModals();
    }

    public function confirmReject($id)
    {
        $this->selectedBorrowing = RoomBorrowing::with(['room', 'user'])->find($id);
        
        if ($this->selectedBorrowing && $this->selectedBorrowing->status === 'pending') {
            $this->showRejectionModal = true;
        }
    }

    public function reject()
    {
        $this->validate([
            'rejectionReason' => 'required|string|min:10',
        ]);

        if (!$this->selectedBorrowing) {
            return;
        }

        $this->selectedBorrowing->update([
            'status' => 'rejected',
            'rejection_reason' => $this->rejectionReason,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        // Send email notification
        try {
            Mail::to($this->selectedBorrowing->user->email)->send(
                new RoomBorrowingStatusUpdated($this->selectedBorrowing)
            );
        } catch (\Exception $e) {
            \Log::error('Failed to send rejection email: ' . $e->getMessage());
        }

        session()->flash('message', 'Peminjaman ruangan telah ditolak.');
        
        $this->closeModals();
    }

    public function closeModals()
    {
        $this->showApprovalModal = false;
        $this->showRejectionModal = false;
        $this->selectedBorrowing = null;
        $this->rejectionReason = '';
    }

    public function render()
    {
        $query = RoomBorrowing::with(['room', 'user'])->where('status', 'pending');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('booking_number', 'like', '%' . $this->search . '%')
                  ->orWhere('borrower_name', 'like', '%' . $this->search . '%')
                  ->orWhereHas('room', function($q2) {
                      $q2->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        $pendingBookings = $query->orderBy('created_at', 'asc')->paginate(10);

        return view('livewire.room-borrowings.approval', [
            'pendingBookings' => $pendingBookings,
        ])->layout('layouts.app');
    }
}
