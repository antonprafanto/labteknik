<?php

namespace App\Livewire\DamageReports;

use App\Models\DamageReport;
use Livewire\Component;

class Show extends Component
{
    public DamageReport $report;
    
    // Edit fields
    public $status;
    public $repair_cost;
    public $repair_notes;
    public $repair_date;

    protected $rules = [
        'status' => 'required|in:reported,in_progress,completed,cannot_be_repaired,cancelled',
        'repair_cost' => 'nullable|numeric|min:0',
        'repair_notes' => 'nullable|string',
        'repair_date' => 'nullable|date',
    ];

    public function mount(DamageReport $report)
    {
        $this->report = $report;
        
        // Check access
        $user = auth()->user();
        if (!$user->hasRole('super_admin') && 
            !$user->hasRole('head_of_lab') && 
            !$user->hasRole('lab_assistant') && 
            $user->id !== $report->reporter_id) {
            abort(403);
        }

        $this->status = $report->status;
        $this->repair_cost = $report->repair_cost;
        $this->repair_notes = $report->repair_notes;
        $this->repair_date = $report->repair_date ? $report->repair_date->format('Y-m-d') : null;
    }

    public function updateStatus()
    {
        $user = auth()->user();
        if (!$user->hasRole('super_admin') && !$user->hasRole('head_of_lab') && !$user->hasRole('lab_assistant')) {
            abort(403, 'Unauthorized to update status.');
        }

        $this->validate();

        $updateData = [
            'status' => $this->status,
            'repair_notes' => $this->repair_notes,
        ];

        if ($this->status === 'completed' || $this->status === 'in_progress') {
             // If marking as completed or in progress, we might want to set repair details
             if ($this->repair_cost) $updateData['repair_cost'] = $this->repair_cost;
             if ($this->repair_date) $updateData['repair_date'] = $this->repair_date;
             $updateData['repaired_by'] = auth()->id();
        }
        
        // If completed, maybe update item status back to 'available' or 'good'?
        // The requirements say: "Status: dilaporkan, sedang diperbaiki, selesai, tidak dapat diperbaiki"
        // If 'completed', it implies repair is done. If 'cannot_be_repaired', item might be 'damaged'.
        
        $item = $this->report->inventoryItem;
        if ($this->status === 'completed') {
            $item->update(['status' => 'available', 'condition' => 'good']); // Or fair?
            
            // Auto-create Maintenance Log
            \App\Models\MaintenanceLog::create([
                'inventory_item_id' => $item->id,
                'technician_id' => auth()->id(),
                'maintenance_date' => $this->repair_date ?? now(),
                'maintenance_type' => 'repair',
                'description' => 'Perbaikan dari Laporan Kerusakan #' . $this->report->id . ': ' . $this->report->damage_type,
                'cost' => $this->repair_cost ?? 0,
                'notes' => $this->repair_notes,
            ]);

        } elseif ($this->status === 'cannot_be_repaired') {
            $item->update(['status' => 'damaged', 'condition' => 'damaged']);
        } elseif ($this->status === 'in_progress') {
             $item->update(['status' => 'maintenance']);
        }

        $this->report->update($updateData);

        session()->flash('message', 'Report status updated successfully.');
    }

    public function render()
    {
        return view('livewire.damage-reports.show');
    }
}
