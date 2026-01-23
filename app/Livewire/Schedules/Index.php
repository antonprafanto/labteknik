<?php

namespace App\Livewire\Schedules;

use App\Models\Laboratory;
use App\Models\PracticumSchedule;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedLab = '';
    public $dateFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedLab' => ['except' => ''],
        'dateFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedLab()
    {
        $this->resetPage();
    }

    public function updatingDateFilter()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $schedule = PracticumSchedule::findOrFail($id);
        $schedule->delete();
        session()->flash('message', 'Schedule deleted successfully.');
    }

    public function render()
    {
        $schedules = PracticumSchedule::with(['laboratory', 'lecturer'])
            ->when($this->search, function ($query) {
                $query->where('course_name', 'like', '%' . $this->search . '%')
                      ->orWhere('class_name', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedLab, function ($query) {
                $query->where('laboratory_id', $this->selectedLab);
            })
            ->when($this->dateFilter, function ($query) {
                $query->whereDate('schedule_date', $this->dateFilter);
            })
            ->orderBy('schedule_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->paginate(10);

        return view('livewire.schedules.index', [
            'schedules' => $schedules,
            'laboratories' => Laboratory::all(),
        ]);
    }
}
