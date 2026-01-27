<?php

namespace App\Livewire\RoomBorrowings;

use App\Models\RoomBorrowing;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function cancel($id)
    {
        $borrowing = RoomBorrowing::find($id);
        
        if (!$borrowing) {
            return;
        }

        // Only owner can cancel, and only if status is pending
        if ($borrowing->user_id === Auth::id() && $borrowing->status === 'pending') {
            $borrowing->update(['status' => 'cancelled']);
            session()->flash('message', 'Peminjaman ruangan berhasil dibatalkan.');
        }
    }

    public function render()
    {
        $user = Auth::user();
        $query = RoomBorrowing::with(['room', 'user', 'approver']);

        // User can see only their bookings, admin/lab staff can see all
        if (!$user->hasRole(['super_admin', 'head_of_lab', 'lab_assistant'])) {
            $query->where('user_id', $user->id);
        }

        if ($this->search) {
            $query->where(function($q) {
                $q->where('booking_number', 'like', '%' . $this->search . '%')
                  ->orWhere('borrower_name', 'like', '%' . $this->search . '%')
                  ->orWhereHas('room', function($q2) {
                      $q2->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.room-borrowings.index', [
            'bookings' => $bookings,
        ])->layout('layouts.app');
    }
}
