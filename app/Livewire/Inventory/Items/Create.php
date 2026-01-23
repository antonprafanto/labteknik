<?php

namespace App\Livewire\Inventory\Items;

use App\Models\InventoryCategory;
use App\Models\InventoryItem;
use App\Models\Laboratory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $brand;
    public $model;
    public $description;
    public $purchase_year;
    public $condition = 'good';
    public $status = 'available';
    public $quantity = 1;
    public $laboratory_id;
    public $category_id;
    public $price;
    public $image;
    public $specifications = [];

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

    public function save()
    {
        $this->validate();

        $path = $this->image ? $this->image->store('inventory_items', 'public') : null;

        // Generate a unique code based on category and random string
        $categoryCode = Str::upper(Str::substr(InventoryCategory::find($this->category_id)->name, 0, 3));
        $uniqueCode = $categoryCode . '-' . date('Y') . '-' . Str::upper(Str::random(5));

        InventoryItem::create([
            'code' => $uniqueCode,
            'name' => $this->name,
            'brand' => $this->brand,
            'model' => $this->model,
            'description' => $this->description,
            'purchase_year' => $this->purchase_year,
            'condition' => $this->condition,
            'status' => $this->status,
            'quantity' => $this->quantity,
            'available_quantity' => $this->quantity, // Initially same as quantity
            'laboratory_id' => $this->laboratory_id,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'image_path' => $path,
            'specifications' => $this->specifications,
        ]);

        return redirect()->route('admin.inventory.items.index');
    }

    public function render()
    {
        return view('livewire.inventory.items.create', [
            'categories' => InventoryCategory::all(),
            'laboratories' => Laboratory::all(),
        ])->layout('layouts.app');
    }
}
