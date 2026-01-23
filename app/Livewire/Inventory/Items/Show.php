<?php

namespace App\Livewire\Inventory\Items;

use App\Models\InventoryItem;
use App\Models\MaintenanceLog;
use Livewire\Component;

class Show extends Component
{
    public InventoryItem $item;

    // Maintenance Log Form
    public $showMaintenanceModal = false;
    public $maintenance_type = 'routine_check';
    public $description;
    public $cost = 0;
    public $next_maintenance_date;

    protected $rules = [
        'maintenance_type' => 'required|string',
        'description' => 'required|string|min:5',
        'cost' => 'nullable|numeric|min:0',
        'next_maintenance_date' => 'nullable|date|after:today',
    ];

    public function mount(InventoryItem $item)
    {
        $this->item = $item;
    }

    public function getQrCodeUrlProperty()
    {
        // Using a public API for QR code generation for simplicity
        return 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $this->item->code;
    }

    public function openMaintenanceModal()
    {
        $this->reset(['maintenance_type', 'description', 'cost', 'next_maintenance_date']);
        $this->showMaintenanceModal = true;
    }

    public function saveMaintenanceLog()
    {
        $this->validate();

        MaintenanceLog::create([
            'inventory_item_id' => $this->item->id,
            'technician_id' => auth()->id(),
            'maintenance_date' => now(),
            'maintenance_type' => $this->maintenance_type,
            'description' => $this->description,
            'cost' => $this->cost ?? 0,
            'next_maintenance_date' => $this->next_maintenance_date,
        ]);

        $this->showMaintenanceModal = false;
        session()->flash('message', 'Maintenance log added successfully.');
    }

    public function render()
    {
        return view('livewire.inventory.items.show', [
            'maintenanceLogs' => $this->item->maintenanceLogs()->latest()->get(),
            'damageReports' => $this->item->damageReports()->latest()->get(),
        ])->layout('layouts.app');
    }
}
