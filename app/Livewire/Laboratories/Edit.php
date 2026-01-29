<?php

namespace App\Livewire\Laboratories;

use App\Models\Laboratory;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Laboratory $laboratory;

    public $name;
    public $location;
    public $room_number;
    public $capacity;
    public $area;
    public $status;
    public $description;
    public $head_lab_id;
    public $floor_plan;
    public $current_floor_plan;

    protected $rules = [
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'room_number' => 'required|string|max:50',
        'capacity' => 'required|integer|min:1',
        'area' => 'required|numeric|min:1',
        'status' => 'required|in:aktif,maintenance,tidak_aktif',
        'description' => 'nullable|string',
        'head_lab_id' => 'nullable|exists:users,id',
        'floor_plan' => 'nullable|image|max:2048',
    ];

    public function mount(Laboratory $laboratory)
    {
        $this->laboratory = $laboratory;
        $this->name = $laboratory->name;
        $this->location = $laboratory->location;
        $this->room_number = $laboratory->room_number;
        $this->capacity = $laboratory->capacity;
        $this->area = $laboratory->area;
        $this->status = $laboratory->status;
        $this->description = $laboratory->description;
        $this->head_lab_id = $laboratory->head_lab_id;
        $this->current_floor_plan = $laboratory->floor_plan_path;
    }

    public function save()
    {
        $this->validate();

        // Store old head_lab_id for comparison
        $oldHeadId = $this->laboratory->head_lab_id;

        if ($this->floor_plan) {
            $path = $this->floor_plan->store('floor_plans', 'public');
        } else {
            $path = $this->laboratory->floor_plan_path;
        }

        $this->laboratory->update([
            'name' => $this->name,
            'location' => $this->location,
            'room_number' => $this->room_number,
            'capacity' => $this->capacity,
            'area' => $this->area,
            'status' => $this->status,
            'description' => $this->description,
            'head_lab_id' => $this->head_lab_id,
            'floor_plan_path' => $path,
        ]);

        // Sync: Handle head changes
        // Clear old head's laboratory_id if head changed
        if ($oldHeadId && $oldHeadId != $this->head_lab_id) {
            User::where('id', $oldHeadId)
                ->where('laboratory_id', $this->laboratory->id)
                ->update(['laboratory_id' => null]);
        }

        // Set new head's laboratory_id
        if ($this->head_lab_id) {
            User::where('id', $this->head_lab_id)->update(['laboratory_id' => $this->laboratory->id]);
        }

        session()->flash('message', 'Laboratorium berhasil diperbarui.');

        return redirect()->route('admin.laboratories.index');
    }

    public function render()
    {
        return view('livewire.laboratories.edit', [
            // Show head_of_lab users: unassigned OR currently assigned to this lab
            'heads' => User::where('role', 'head_of_lab')
                ->where(function ($query) {
                    $query->whereNull('laboratory_id')
                          ->orWhere('laboratory_id', $this->laboratory->id);
                })
                ->get(),
        ])->layout('layouts.app');
    }
}
