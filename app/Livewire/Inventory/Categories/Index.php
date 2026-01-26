<?php

namespace App\Livewire\Inventory\Categories;

use App\Models\InventoryCategory;
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
            $category = InventoryCategory::find($this->itemToDelete);
            if ($category) {
                $category->delete();
            }
        }
        
        $this->confirmingDeletion = false;
        $this->itemToDelete = null;
    }

    public function render()
    {
        $categories = InventoryCategory::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.inventory.categories.index', [
            'categories' => $categories,
        ])->layout('layouts.app');
    }
}
