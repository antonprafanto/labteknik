<?php

namespace App\Livewire\Rooms;

use App\Models\Room;
use App\Models\Laboratory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $confirmingDeletion = false;
    public $itemToDelete = null;

    public function confirmDelete($id)
    {
        $this->itemToDelete = $id;
        $this->confirmingDeletion = true;
    }

    public function deleteItem()
    {
        if ($this->itemToDelete) {
            $room = Room::find($this->itemToDelete);
            if ($room) {
                $room->delete();
                session()->flash('message', 'Ruangan berhasil dihapus.');
            }
        }
        
        $this->confirmingDeletion = false;
        $this->itemToDelete = null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Room::with('laboratory');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('code', 'like', '%' . $this->search . '%')
                  ->orWhere('location', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $rooms = $query->orderBy('name')->paginate(10);

        return view('livewire.rooms.index', [
            'rooms' => $rooms,
        ])->layout('layouts.app');
    }
}
