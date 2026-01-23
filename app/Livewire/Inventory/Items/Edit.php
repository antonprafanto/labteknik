<?php

namespace App\Livewire\Inventory\Items;

use App\Models\InventoryCategory;
use App\Models\InventoryItem;
use App\Models\Laboratory;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public InventoryItem $item;

    public $name;
    public $brand;
    public $model;
    public $description;
    public $purchase_year;
    public $condition;
    public $status;
    public $quantity;
    public $laboratory_id;
    public $category_id;
    public $price;
    public $image;
    public $current_image;

    protected $rules = [
        'name' => 'required|string|max:255',
        'brand' => 'nullable|string|max:255',
        'model' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'purchase_year' => 'required|integer|min:1900|max:2099',
        'condition' => 'required|in:good,fair,poor,damaged',
        'status' => 'required|in:available,borrowed,maintenance,damaged,lost',
        'quantity' => 'required|integer|min:1',
        'laboratory_id' => 'required|exists:laboratories,id',
        'category_id' => 'required|exists:inventory_categories,id',
        'price' => 'nullable|numeric|min:0',
        'image' => 'nullable|image|max:2048',
    ];

    public function mount(InventoryItem $item)
    {
        $this->item = $item;
        $this->name = $item->name;
        $this->brand = $item->brand;
        $this->model = $item->model;
        $this->description = $item->description;
        $this->purchase_year = $item->purchase_year;
        $this->condition = $item->condition;
        $this->status = $item->status;
        $this->quantity = $item->quantity;
        $this->laboratory_id = $item->laboratory_id;
        $this->category_id = $item->category_id;
        $this->price = $item->price;
        $this->current_image = $item->image_path;
    }

    public function save()
    {
        $this->validate();

        if ($this->image) {
            $path = $this->image->store('inventory_items', 'public');
        } else {
            $path = $this->item->image_path;
        }

        $this->item->update([
            'name' => $this->name,
            'brand' => $this->brand,
            'model' => $this->model,
            'description' => $this->description,
            'purchase_year' => $this->purchase_year,
            'condition' => $this->condition,
            'status' => $this->status,
            'quantity' => $this->quantity,
            // Note: updating available quantity logic might be needed if quantity changes significantly
            'laboratory_id' => $this->laboratory_id,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'image_path' => $path,
        ]);

        return redirect()->route('admin.inventory.items.index');
    }

    public function render()
    {
        return view('livewire.inventory.items.edit', [
            'categories' => InventoryCategory::all(),
            'laboratories' => Laboratory::all(),
        ])->layout('layouts.app');
    }
}
