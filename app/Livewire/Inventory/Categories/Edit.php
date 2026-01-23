<?php

namespace App\Livewire\Inventory\Categories;

use App\Models\InventoryCategory;
use Livewire\Component;

class Edit extends Component
{
    public InventoryCategory $category;

    public $name;
    public $description;
    public $color;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:inventory_categories,name,' . $this->category->id,
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:50',
        ];
    }

    public function mount(InventoryCategory $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->color = $category->color;
    }

    public function save()
    {
        $this->validate();

        $this->category->update([
            'name' => $this->name,
            'description' => $this->description,
            'color' => $this->color,
        ]);

        return redirect()->route('admin.inventory.categories.index');
    }

    public function render()
    {
        return view('livewire.inventory.categories.edit')->layout('layouts.app');
    }
}
