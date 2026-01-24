<?php

namespace App\Livewire\Schedules;

use App\Models\Laboratory;
use App\Models\PracticumSchedule;
use Livewire\Component;

class Calendar extends Component
{
    public $laboratory_id = null;

    public function render()
    {
        $laboratories = Laboratory::all();
        
        $this->dispatch('refreshCalendar', $this->getEvents());

        return view('livewire.schedules.calendar', [
            'laboratories' => $laboratories,
            'events' => $this->getEvents(),
        ])->layout('layouts.app');
    }

    public function getEvents()
    {
        $query = PracticumSchedule::query();

        if ($this->laboratory_id) {
            $query->where('laboratory_id', $this->laboratory_id);
        }

        $schedules = $query->with(['laboratory', 'lecturer'])->get();

        return $schedules->map(function ($schedule) {
            // Map recurring day (1-7) to a real date in the current week
            // Carbon's dayOfWeek: 0 (Sun) - 6 (Sat). My day_of_week: 1 (Mon) - 7 (Sun)
            // Carbon setISODate uses year, week, day (1=Mon, 7=Sun). Perfect match!
            
            $now = now();
            $date = $now->setISODate($now->year, $now->weekOfYear, $schedule->day_of_week);
            $dateStr = $date->format('Y-m-d');

            return [
                'id' => $schedule->id,
                'title' => $schedule->course_name . ' (' . $schedule->class_name . ')',
                'start' => $dateStr . 'T' . $schedule->start_time,
                'end' => $dateStr . 'T' . $schedule->end_time,
                'color' => $this->getColor($schedule->laboratory_id),
                'extendedProps' => [
                    'laboratory' => $schedule->laboratory->name,
                    'lecturer' => $schedule->lecturer->name ?? '-',
                    'participants' => $schedule->participants,
                ],
            ];
        });
    }

    private function getColor($labId)
    {
        $colors = [
            '#1d4ed8', // Blue 700
            '#047857', // Emerald 700
            '#b45309', // Amber 700
            '#b91c1c', // Red 700
            '#6d28d9', // Violet 700
            '#be185d', // Pink 700
        ];

        return $colors[$labId % count($colors)] ?? '#374151'; // Gray 700
    }
}
