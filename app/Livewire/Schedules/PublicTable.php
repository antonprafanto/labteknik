<?php

namespace App\Livewire\Schedules;

use App\Models\Laboratory;
use App\Models\PracticumSchedule;
use Livewire\Component;

class PublicTable extends Component
{
    public $selectedLab = '';
    public $laboratories = [];
    
    // Time slots standar praktikum
    public $timeSlots = [
        '07:30 - 09:00',
        '09:10 - 10:40',
        '10:50 - 12:20',
        '13:00 - 14:30',
        '14:40 - 16:10',
        '15:10 - 16:40',
    ];
    
    public $days = [
        1 => 'SENIN',
        2 => 'SELASA',
        3 => 'RABU',
        4 => 'KAMIS',
        5 => 'JUMAT',
    ];

    public function mount()
    {
        $this->laboratories = Laboratory::orderBy('name')->get();
        if ($this->laboratories->count() > 0) {
            $this->selectedLab = $this->laboratories->first()->id;
        }
    }

    public function selectLab($labId)
    {
        $this->selectedLab = $labId;
    }

    public function getSchedulesProperty()
    {
        if (!$this->selectedLab) {
            return collect();
        }

        return PracticumSchedule::with(['laboratory', 'lecturer'])
            ->where('laboratory_id', $this->selectedLab)
            ->where('status', '!=', 'cancelled')
            ->orderBy('schedule_date')
            ->orderBy('start_time')
            ->get()
            ->groupBy(function ($schedule) {
                return $schedule->schedule_date->dayOfWeek;
            });
    }

    public function getScheduleForSlot($dayNumber, $timeSlot)
    {
        $schedules = $this->schedules;
        
        if (!isset($schedules[$dayNumber])) {
            return null;
        }

        // Parse time slot
        $times = explode(' - ', $timeSlot);
        $slotStart = $times[0];
        $slotEnd = $times[1];

        return $schedules[$dayNumber]->filter(function ($schedule) use ($slotStart, $slotEnd) {
            $scheduleStart = \Carbon\Carbon::parse($schedule->start_time)->format('H:i');
            $scheduleEnd = \Carbon\Carbon::parse($schedule->end_time)->format('H:i');
            
            return $scheduleStart === $slotStart || 
                   ($scheduleStart >= $slotStart && $scheduleStart < $slotEnd);
        })->first();
    }

    public function render()
    {
        return view('livewire.schedules.public-table')
            ->layout('layouts.guest');
    }
}
