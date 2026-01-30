<?php

namespace App\Livewire\LabActivities;

use App\Models\LabActivity;
use App\Models\LabActivityCategory;
use App\Models\Laboratory;
use Livewire\Component;
use Livewire\WithPagination;

class Gallery extends Component
{
    use WithPagination;

    public $categoryFilter = '';
    public $laboratoryFilter = '';
    public $selectedActivity = null;
    public $showModal = false;

    protected $queryString = [
        'categoryFilter' => ['except' => ''],
        'laboratoryFilter' => ['except' => ''],
    ];

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function updatingLaboratoryFilter()
    {
        $this->resetPage();
    }

    public function viewActivity($id)
    {
        $this->selectedActivity = LabActivity::with(['category', 'laboratory'])->find($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedActivity = null;
    }

    public function render()
    {
        $activities = LabActivity::query()
            ->with(['category', 'laboratory'])
            ->when($this->categoryFilter, function ($query) {
                $query->where('lab_activity_category_id', $this->categoryFilter);
            })
            ->when($this->laboratoryFilter, function ($query) {
                $query->where('laboratory_id', $this->laboratoryFilter);
            })
            ->orderBy('activity_date', 'desc')
            ->paginate(12);

        return view('livewire.lab-activities.gallery', [
            'activities' => $activities,
            'categories' => LabActivityCategory::all(),
            'laboratories' => Laboratory::all(),
        ]);
    }
}
