<?php

namespace App\Livewire\Rooms;

use App\Models\Room;
use App\Models\Laboratory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $name = '';
    public $code = '';
    public $capacity = 0;
    public $facilities = '';
    public $location = '';
    public $floor = '';
    public $status = 'available';
    public $photo;
    public $description = '';
    public $laboratory_id = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:50|unique:rooms,code',
        'capacity' => 'required|integer|min:0',
        'facilities' => 'nullable|string',
        'location' => 'required|string|max:255',
        'floor' => 'nullable|string|max:50',
        'status' => 'required|in:available,maintenance,unavailable',
        'photo' => 'nullable|image|max:2048',
        'description' => 'nullable|string',
        'laboratory_id' => 'nullable|exists:laboratories,id',
    ];

    public function save()
    {
        $this->validate();

        $photoPath = null;
        if ($this->photo) {
            $photoPath = $this->photo->store('room_photos', 'public');
        }

        // Convert facilities string to array
        $facilitiesArray = null;
        if ($this->facilities) {
            $facilitiesArray = array_map('trim', explode(',', $this->facilities));
        }

        Room::create([
            'name' => $this->name,
            'code' => $this->code,
            'capacity' => $this->capacity,
            'facilities' => $facilitiesArray,
            'location' => $this->location,
            'floor' => $this->floor,
            'status' => $this->status,
            'photo' => $photoPath,
            'description' => $this->description,
            'laboratory_id' => $this->laboratory_id ?: null,
        ]);

        session()->flash('message', 'Ruangan berhasil ditambahkan.');

        return redirect()->route('admin.rooms.index');
    }

    public function render()
    {
        $laboratories = Laboratory::orderBy('name')->get();

        return view('livewire.rooms.create', [
            'laboratories' => $laboratories,
        ])->layout('layouts.app');
    }
}
