<?php

namespace App\Livewire\Inventory;

use App\Models\InventoryItem;
use Livewire\Component;

class Scan extends Component
{
    public $scannedCode = '';
    public $errorMessage = '';

    public function handleScan($code)
    {
        $this->scannedCode = $code;
        $this->errorMessage = '';

        $item = InventoryItem::where('code', $code)->first();

        if ($item) {
            return redirect()->route('admin.inventory.items.show', $item);
        } else {
            $this->errorMessage = 'Item not found with code: ' . $code;
        }
    }

    public function render()
    {
        return view('livewire.inventory.scan')->layout('layouts.app');
    }
}
