<?php

namespace App\Livewire\LabActivities;

use App\Models\LabActivity;
use App\Models\LabActivityCategory;
use App\Models\Laboratory;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $activityId;
    public $title = '';
    public $description = '';
    public $activity_date;
    public $laboratory_id = '';
    public $lab_activity_category_id = '';
    public $photo;
    public $existingPhotoPath;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'activity_date' => 'required|date',
        'laboratory_id' => 'required|exists:laboratories,id',
        'lab_activity_category_id' => 'required|exists:lab_activity_categories,id',
        'photo' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'title.required' => 'Judul kegiatan wajib diisi.',
        'activity_date.required' => 'Tanggal kegiatan wajib diisi.',
        'laboratory_id.required' => 'Laboratorium wajib dipilih.',
        'lab_activity_category_id.required' => 'Kategori kegiatan wajib dipilih.',
        'photo.image' => 'File harus berupa gambar.',
        'photo.max' => 'Ukuran foto maksimal 2MB.',
    ];

    public function mount($id)
    {
        $activity = LabActivity::findOrFail($id);

        $this->activityId = $activity->id;
        $this->title = $activity->title;
        $this->description = $activity->description;
        $this->activity_date = $activity->activity_date->format('Y-m-d');
        $this->laboratory_id = $activity->laboratory_id;
        $this->lab_activity_category_id = $activity->lab_activity_category_id;
        $this->existingPhotoPath = $activity->photo_path;
    }

    public function updatedPhoto()
    {
        $this->validateOnly('photo');
    }

    public function removePhoto()
    {
        $this->photo = null;
    }

    public function removeExistingPhoto()
    {
        $this->existingPhotoPath = null;
    }

    public function save()
    {
        $this->validate();

        $activity = LabActivity::findOrFail($this->activityId);

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'activity_date' => $this->activity_date,
            'laboratory_id' => $this->laboratory_id,
            'lab_activity_category_id' => $this->lab_activity_category_id,
        ];

        // Handle photo upload
        if ($this->photo) {
            // Delete old photo
            if ($activity->photo_path && Storage::disk('public')->exists($activity->photo_path)) {
                Storage::disk('public')->delete($activity->photo_path);
            }
            $data['photo_path'] = $this->photo->store('lab-activities', 'public');
        } elseif (!$this->existingPhotoPath && $activity->photo_path) {
            // User removed existing photo
            if (Storage::disk('public')->exists($activity->photo_path)) {
                Storage::disk('public')->delete($activity->photo_path);
            }
            $data['photo_path'] = null;
        }

        $activity->update($data);

        session()->flash('message', 'Kegiatan laboratorium berhasil diperbarui.');

        return redirect()->route('admin.lab-activities.index');
    }

    public function render()
    {
        return view('livewire.lab-activities.edit', [
            'categories' => LabActivityCategory::all(),
            'laboratories' => Laboratory::all(),
        ])->layout('layouts.app');
    }
}
