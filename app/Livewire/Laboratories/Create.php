<?php

namespace App\Livewire\Laboratories;

use App\Models\Laboratory;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $location;
    public $room_number;
    public $capacity;
    public $area;
    public $status = 'aktif';
    public $description;
    public $head_lab_id;
    public $floor_plan;

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

    public function save()
    {
        $this->validate();

        $path = $this->floor_plan ? $this->floor_plan->store('floor_plans', 'public') : null;

        Laboratory::create([
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

        return redirect()->route('admin.laboratories.index');
    }

    public function render()
    {
        return view('livewire.laboratories.create', [
            'heads' => User::where('role', 'head_of_lab')->get(),
        ])->layout('layouts.app');
    }
}
