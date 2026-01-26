<?php

namespace App\Livewire\Laboratories;

use App\Models\Laboratory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
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
            $laboratory = Laboratory::find($this->itemToDelete);
            if ($laboratory) {
                $laboratory->delete();
            }
        }
        
        $this->confirmingDeletion = false;
        $this->itemToDelete = null;
    }

    public function render()
    {
        $laboratories = Laboratory::with(['head', 'technicians'])
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('location', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.laboratories.index', [
            'laboratories' => $laboratories,
        ])->layout('layouts.app');
    }
}
