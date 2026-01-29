<?php

namespace App\Livewire\Laboratories;

use App\Models\Laboratory;
use App\Models\User;
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
                // Clear laboratory_id for users assigned to this lab
                // Note: DB has nullOnDelete but we do this explicitly for clarity
                User::where('laboratory_id', $laboratory->id)->update(['laboratory_id' => null]);
                
                $laboratory->delete();
                session()->flash('message', 'Laboratorium berhasil dihapus.');
            }
        }
        
        $this->confirmingDeletion = false;
        $this->itemToDelete = null;
    }

    public function render()
    {
        $user = auth()->user();
        
        $query = Laboratory::with(['head', 'technicians']);
        
        // Filter: Kepala lab only sees their own laboratory
        if ($user->hasRole('head_of_lab')) {
            $query->where('head_lab_id', $user->id);
        }
        
        // Search filter
        $query->where(function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
              ->orWhere('location', 'like', '%' . $this->search . '%');
        });

        $laboratories = $query->paginate(10);

        return view('livewire.laboratories.index', [
            'laboratories' => $laboratories,
        ])->layout('layouts.app');
    }
}

