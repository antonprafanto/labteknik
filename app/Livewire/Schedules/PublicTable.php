<?php

namespace App\Livewire\Schedules;

use App\Models\Laboratory;
use App\Models\PracticumSchedule;
use App\Models\TimeSlot;
use Livewire\Component;

class PublicTable extends Component
{
    public $selectedLab = '';
    public $laboratories = [];
    
    // Default time slots (fallback if no slots in database)
    protected $defaultTimeSlots = [
        '07:30 - 09:00',
        '09:10 - 10:40',
        '10:50 - 12:20',
        '13:00 - 14:30',
        '14:40 - 16:00',
    ];

    protected $defaultFridayTimeSlots = [
        '07:30 - 09:00',
        '09:10 - 10:40',
        '11:00 - 13:00',
        '13:30 - 15:00',
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

    /**
     * Get time slots for regular days (Mon-Thu) from database or fallback
     */
    public function getTimeSlotsProperty()
    {
        $slots = $this->fetchTimeSlots(false);
        
        if ($slots->isEmpty()) {
            return collect($this->defaultTimeSlots)->map(function ($slot) {
                return [
                    'time_range' => $slot,
                    'is_break' => false,
                    'break_label' => null,
                ];
            });
        }

        return $slots->map(function ($slot) {
            return [
                'time_range' => $slot->start_time->format('H:i') . ' - ' . $slot->end_time->format('H:i'),
                'is_break' => $slot->is_break,
                'break_label' => $slot->break_label,
            ];
        });
    }

    /**
     * Get time slots for Friday from database or fallback
     */
    public function getFridayTimeSlotsProperty()
    {
        $slots = $this->fetchTimeSlots(true);
        
        if ($slots->isEmpty()) {
            return collect($this->defaultFridayTimeSlots)->map(function ($slot, $index) {
                return [
                    'time_range' => $slot,
                    'is_break' => ($index == 2), // Third slot is break by default
                    'break_label' => ($index == 2) ? 'ISTIRAHAT SHOLAT JUM\'AT' : null,
                ];
            });
        }

        return $slots->map(function ($slot) {
            return [
                'time_range' => $slot->start_time->format('H:i') . ' - ' . $slot->end_time->format('H:i'),
                'is_break' => $slot->is_break,
                'break_label' => $slot->break_label,
            ];
        });
    }

    /**
     * Get slots from database
     */
    protected function fetchTimeSlots($isFriday)
    {
        // First try lab-specific slots
        $slots = TimeSlot::where('laboratory_id', $this->selectedLab)
            ->where('is_friday', $isFriday)
            ->active()
            ->ordered()
            ->get();

        // Fallback to global slots
        if ($slots->isEmpty()) {
            $slots = TimeSlot::whereNull('laboratory_id')
                ->where('is_friday', $isFriday)
                ->active()
                ->ordered()
                ->get();
        }

        return $slots;
    }

    public function getSchedulesProperty()
    {
        if (!$this->selectedLab) {
            return collect();
        }

        return PracticumSchedule::with(['laboratory', 'lecturer'])
            ->where('laboratory_id', $this->selectedLab)
            ->where('status', '!=', 'cancelled')
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get()
            ->groupBy('day_of_week');
    }

    public function getScheduleForSlot($dayNumber, $timeRange)
    {
        $schedules = $this->schedules;
        
        if (!isset($schedules[$dayNumber])) {
            return null;
        }

        // Parse time slot
        $times = explode(' - ', $timeRange);
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
