<?php

namespace App\Livewire\Inventory\Categories;

use App\Models\InventoryCategory;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $description;
    public $color = '#6366f1'; // Default indigo color

    protected $rules = [
        'name' => 'required|string|max:255|unique:inventory_categories,name',
        'description' => 'nullable|string',
        'color' => 'nullable|string|max:50',
    ];

    public function save()
    {
        $this->validate();

        InventoryCategory::create([
            'name' => $this->name,
            'description' => $this->description,
            'color' => $this->color,
        ]);

        return redirect()->route('admin.inventory.categories.index');
    }

    public function render()
    {
        return view('livewire.inventory.categories.create')->layout('layouts.app');
    }
}
