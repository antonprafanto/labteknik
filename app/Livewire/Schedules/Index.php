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
    public $dayFilter = '';
    public $viewMode = 'list'; // 'list' or 'grid'

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedLab' => ['except' => ''],
        'dayFilter' => ['except' => ''],
        'viewMode' => ['except' => 'list'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedLab()
    {
        $this->resetPage();
    }

    public function updatingDayFilter()
    {
        $this->resetPage();
    }

    public function setViewMode($mode)
    {
        $this->viewMode = $mode;
    }

    public function delete($id)
    {
        $schedule = PracticumSchedule::findOrFail($id);
        $schedule->delete();
        session()->flash('message', 'Schedule deleted successfully.');
    }

    /**
     * Get schedule grid data for availability visualization
     * Returns array of time slots with their availability status per day
     */
    public function getSlotGrid()
    {
        $timeSlots = [];
        // Generate hourly time slots from 07:00 to 21:00
        for ($hour = 7; $hour <= 21; $hour++) {
            $timeSlots[] = sprintf('%02d:00', $hour);
        }

        $days = [
            1 => 'Senin',
            2 => 'Selasa', 
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu',
        ];

        // Get all schedules for selected lab (or all labs)
        $schedulesQuery = PracticumSchedule::with(['laboratory'])
            ->where('status', '!=', 'cancelled');

        if ($this->selectedLab) {
            $schedulesQuery->where('laboratory_id', $this->selectedLab);
        }

        $schedules = $schedulesQuery->get();

        // Build grid data
        $grid = [];
        foreach ($timeSlots as $timeSlot) {
            $slotHour = (int) substr($timeSlot, 0, 2);
            $row = ['time' => $timeSlot, 'days' => []];

            foreach ($days as $dayNum => $dayName) {
                // Find schedules that cover this time slot on this day
                $occupyingSchedules = $schedules->filter(function ($schedule) use ($slotHour, $dayNum) {
                    if ($schedule->day_of_week != $dayNum) {
                        return false;
                    }
                    $startHour = (int) substr($schedule->start_time, 0, 2);
                    $endHour = (int) substr($schedule->end_time, 0, 2);
                    // Check if this hour falls within the schedule
                    return $slotHour >= $startHour && $slotHour < $endHour;
                });

                $row['days'][$dayNum] = [
                    'available' => $occupyingSchedules->isEmpty(),
                    'schedules' => $occupyingSchedules->map(function ($s) {
                        return [
                            'id' => $s->id,
                            'course' => $s->course_name,
                            'class' => $s->class_name,
                            'year_batch' => $s->year_batch ?? '-',
                            'lab' => $s->laboratory->name ?? '-',
                            'lecturer' => $s->lecturer_name ?? '-',
                            'time' => \Carbon\Carbon::parse($s->start_time)->format('H:i') . '-' . \Carbon\Carbon::parse($s->end_time)->format('H:i'),
                        ];
                    })->values()->all(),
                ];
            }

            $grid[] = $row;
        }

        return ['grid' => $grid, 'days' => $days];
    }

    public function render()
    {
        $schedules = PracticumSchedule::with(['laboratory'])
            ->when($this->search, function ($query) {
                $query->where('course_name', 'like', '%' . $this->search . '%')
                      ->orWhere('class_name', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedLab, function ($query) {
                $query->where('laboratory_id', $this->selectedLab);
            })
            ->when($this->dayFilter, function ($query) {
                $query->where('day_of_week', $this->dayFilter);
            })
            ->orderBy('day_of_week', 'asc')
            ->orderBy('start_time', 'asc')
            ->paginate(10);

        $slotData = $this->getSlotGrid();

        return view('livewire.schedules.index', [
            'schedules' => $schedules,
            'laboratories' => Laboratory::all(),
            'slotGrid' => $slotData['grid'],
            'days' => $slotData['days'],
        ]);
    }
}

