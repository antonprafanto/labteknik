<?php

namespace App\Livewire\LabActivities;

use App\Models\LabActivity;
use App\Models\LabActivityCategory;
use App\Models\Laboratory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = '';
    public $laboratoryFilter = '';
    public $sortBy = 'activity_date';
    public $sortDirection = 'desc';
    public $showDeleteModal = false;
    public $deleteId = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
        'laboratoryFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function updatingLaboratoryFilter()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $activity = LabActivity::find($this->deleteId);
        
        if ($activity) {
            // Delete photo from storage
            if ($activity->photo_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($activity->photo_path)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($activity->photo_path);
            }
            
            $activity->delete();
            session()->flash('message', 'Kegiatan berhasil dihapus.');
        }

        $this->showDeleteModal = false;
        $this->deleteId = null;
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->deleteId = null;
    }

    public function render()
    {
        $activities = LabActivity::query()
            ->with(['category', 'laboratory', 'uploader'])
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->categoryFilter, function ($query) {
                $query->where('lab_activity_category_id', $this->categoryFilter);
            })
            ->when($this->laboratoryFilter, function ($query) {
                $query->where('laboratory_id', $this->laboratoryFilter);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(12);

        return view('livewire.lab-activities.index', [
            'activities' => $activities,
            'categories' => LabActivityCategory::all(),
            'laboratories' => Laboratory::all(),
        ])->layout('layouts.app');
    }
}
