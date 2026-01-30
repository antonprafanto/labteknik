<?php

namespace App\Livewire\LabActivities;

use App\Models\LabActivity;
use App\Models\LabActivityCategory;
use App\Models\Laboratory;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $title = '';
    public $description = '';
    public $activity_date;
    public $laboratory_id = '';
    public $lab_activity_category_id = '';
    public $photo;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'activity_date' => 'required|date',
        'laboratory_id' => 'required|exists:laboratories,id',
        'lab_activity_category_id' => 'required|exists:lab_activity_categories,id',
        'photo' => 'required|image|max:2048', // 2MB max
    ];

    protected $messages = [
        'title.required' => 'Judul kegiatan wajib diisi.',
        'activity_date.required' => 'Tanggal kegiatan wajib diisi.',
        'laboratory_id.required' => 'Laboratorium wajib dipilih.',
        'lab_activity_category_id.required' => 'Kategori kegiatan wajib dipilih.',
        'photo.required' => 'Foto kegiatan wajib diupload.',
        'photo.image' => 'File harus berupa gambar.',
        'photo.max' => 'Ukuran foto maksimal 2MB.',
    ];

    public function mount()
    {
        $this->activity_date = now()->format('Y-m-d');
    }

    public function updatedPhoto()
    {
        $this->validateOnly('photo');
    }

    public function removePhoto()
    {
        $this->photo = null;
    }

    public function save()
    {
        $this->validate();

        $photoPath = $this->photo->store('lab-activities', 'public');

        LabActivity::create([
            'title' => $this->title,
            'description' => $this->description,
            'activity_date' => $this->activity_date,
            'laboratory_id' => $this->laboratory_id,
            'lab_activity_category_id' => $this->lab_activity_category_id,
            'photo_path' => $photoPath,
            'uploaded_by' => auth()->id(),
        ]);

        session()->flash('message', 'Kegiatan laboratorium berhasil ditambahkan.');

        return redirect()->route('admin.lab-activities.index');
    }

    public function render()
    {
        return view('livewire.lab-activities.create', [
            'categories' => LabActivityCategory::all(),
            'laboratories' => Laboratory::all(),
        ])->layout('layouts.app');
    }
}
