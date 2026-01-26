<?php

namespace App\Livewire\Inventory\Items;

use App\Models\InventoryCategory;
use App\Models\InventoryItem;
use App\Models\Laboratory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $category_id = '';
    public $laboratory_id = '';
    public $status = '';
    public $confirmingItemDeletion = false;
    public $itemToDelete = null;

    public function confirmDelete($itemId)
    {
        $this->itemToDelete = $itemId;
        $this->confirmingItemDeletion = true;
    }

    public function deleteItem()
    {
        if ($this->itemToDelete) {
            $item = InventoryItem::find($this->itemToDelete);
            if ($item) {
                $item->delete();
            }
        }
        
        $this->confirmingItemDeletion = false;
        $this->itemToDelete = null;
    }

    public function render()
    {
        $items = InventoryItem::with(['category', 'laboratory'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('code', 'like', '%' . $this->search . '%')
                        ->orWhere('brand', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->category_id, function ($query) {
                $query->where('category_id', $this->category_id);
            })
            ->when($this->laboratory_id, function ($query) {
                $query->where('laboratory_id', $this->laboratory_id);
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.inventory.items.index', [
            'items' => $items,
            'categories' => InventoryCategory::all(),
            'laboratories' => Laboratory::all(),
        ])->layout('layouts.app');
    }
}
