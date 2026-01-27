<?php

namespace App\Livewire\Rooms;

use App\Models\Room;
use App\Models\Laboratory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public Room $room;
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
    public $existingPhoto = '';

    public function mount(Room $room)
    {
        $this->room = $room;
        $this->name = $room->name;
        $this->code = $room->code;
        $this->capacity = $room->capacity;
        $this->facilities = is_array($room->facilities) ? implode(', ', $room->facilities) : '';
        $this->location = $room->location;
        $this->floor = $room->floor ?? '';
        $this->status = $room->status;
        $this->existingPhoto = $room->photo;
        $this->description = $room->description ?? '';
        $this->laboratory_id = $room->laboratory_id ?? '';
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:rooms,code,' . $this->room->id,
            'capacity' => 'required|integer|min:0',
            'facilities' => 'nullable|string',
            'location' => 'required|string|max:255',
            'floor' => 'nullable|string|max:50',
            'status' => 'required|in:available,maintenance,unavailable',
            'photo' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'laboratory_id' => 'nullable|exists:laboratories,id',
        ];
    }

    public function save()
    {
        $this->validate();

        $photoPath = $this->existingPhoto;
        
        if ($this->photo) {
            // Delete old photo if exists
            if ($this->existingPhoto) {
                Storage::disk('public')->delete($this->existingPhoto);
            }
            $photoPath = $this->photo->store('room_photos', 'public');
        }

        // Convert facilities string to array
        $facilitiesArray = null;
        if ($this->facilities) {
            $facilitiesArray = array_map('trim', explode(',', $this->facilities));
        }

        $this->room->update([
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

        session()->flash('message', 'Ruangan berhasil diperbarui.');

        return redirect()->route('admin.rooms.index');
    }

    public function render()
    {
        $laboratories = Laboratory::orderBy('name')->get();

        return view('livewire.rooms.edit', [
            'laboratories' => $laboratories,
        ])->layout('layouts.app');
    }
}
