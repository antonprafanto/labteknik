<?php

namespace App\Livewire\Borrowings;

use App\Models\BorrowingRequest;
use App\Models\InventoryItem;
use App\Services\ActivityLogger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BorrowingStatusUpdated;
use Livewire\Component;
use Livewire\WithPagination;

class Approval extends Component
{
    use WithPagination;

    public $statusFilter = 'pending';

    public function approve($requestId)
    {
        $request = BorrowingRequest::with('items.inventoryItem')->find($requestId);
        
        // Authorization check for head_of_lab
        $user = Auth::user();
        if ($user->role === 'head_of_lab' && $user->laboratory_id) {
            $hasItemsFromLab = $request->items->contains(function ($item) use ($user) {
                return $item->inventoryItem && $item->inventoryItem->laboratory_id === $user->laboratory_id;
            });
            if (!$hasItemsFromLab) {
                session()->flash('error', 'Anda tidak memiliki akses untuk menyetujui peminjaman ini.');
                return;
            }
        }
        
        // Decrement stock for each item
        foreach ($request->items as $item) {
            $inventoryItem = InventoryItem::find($item->inventory_item_id);
            if ($inventoryItem->available_quantity >= $item->quantity) {
                $inventoryItem->decrement('available_quantity', $item->quantity);
                $inventoryItem->status = ($inventoryItem->available_quantity == 0) ? 'borrowed' : 'available'; // Simplified status logic
                $inventoryItem->save();
            } else {
                session()->flash('error', "Insufficient stock for item: {$inventoryItem->name}");
                return;
            }
        }

        $oldStatus = $request->status;

        $request->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => Auth::id(),
        ]);

        ActivityLogger::log('borrowing_status_updated', $request, "Status changed from $oldStatus to approved");

        // Send Email Notification
        if ($request->user && $request->user->email) {
            Mail::to($request->user->email)->send(new BorrowingStatusUpdated($request));
            
            // Send Database Notification
            $request->user->notify(new \App\Notifications\BorrowingStatusUpdated($request));
        }

        session()->flash('message', 'Request approved successfully.');
    }

    public function reject($requestId)
    {
        $request = BorrowingRequest::with('items.inventoryItem')->find($requestId);

        // Authorization check for head_of_lab
        $user = Auth::user();
        if ($user->role === 'head_of_lab' && $user->laboratory_id) {
            $hasItemsFromLab = $request->items->contains(function ($item) use ($user) {
                return $item->inventoryItem && $item->inventoryItem->laboratory_id === $user->laboratory_id;
            });
            if (!$hasItemsFromLab) {
                session()->flash('error', 'Anda tidak memiliki akses untuk menolak peminjaman ini.');
                return;
            }
        }

        $oldStatus = $request->status;

        $request->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(), // Rejected by
        ]);

        ActivityLogger::log('borrowing_status_updated', $request, "Status changed from $oldStatus to rejected");
        
        // Send Email Notification
        if ($request->user && $request->user->email) {
            Mail::to($request->user->email)->send(new BorrowingStatusUpdated($request));
            
            // Send Database Notification
            $request->user->notify(new \App\Notifications\BorrowingStatusUpdated($request));
        }
        
        session()->flash('message', 'Request rejected.');
    }

    public function render()
    {
        $user = Auth::user();
        
        $query = BorrowingRequest::with(['user', 'items'])
            ->when($this->statusFilter, function($query) {
                return $query->where('status', $this->statusFilter);
            });

        // Kepala lab only sees borrowing requests with items from their lab
        if ($user->role === 'head_of_lab' && $user->laboratory_id) {
            $query->whereHas('items.inventoryItem', function($q) use ($user) {
                $q->where('laboratory_id', $user->laboratory_id);
            });
        }
        
        $requests = $query->latest()->paginate(10);

        return view('livewire.borrowings.approval', [
            'requests' => $requests,
        ])->layout('layouts.app');
    }
}
