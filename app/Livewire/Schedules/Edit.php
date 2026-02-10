<?php

namespace App\Livewire\Schedules;

use App\Models\Laboratory;
use App\Models\PracticumSchedule;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public PracticumSchedule $schedule;

    public $laboratory_id;
    public $lecturer_id;
    public $course_name;
    public $class_name;
    public $year_batch;
    public $day_of_week;
    public $start_time;
    public $end_time;
    public $participants;
    public $notes;
    public $status;

    protected $rules = [
        'laboratory_id' => 'required|exists:laboratories,id',
        'lecturer_id' => 'required|exists:users,id',
        'course_name' => 'required|string|max:255',
        'class_name' => 'required|string|max:100',
        'year_batch' => 'nullable|string|max:50',
        'day_of_week' => 'required|integer|min:1|max:7',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
        'participants' => 'required|integer|min:1',
        'notes' => 'nullable|string',
        'status' => 'required|in:scheduled,ongoing,completed,cancelled',
    ];

    public function mount(PracticumSchedule $schedule)
    {
        // Only super_admin and head_of_lab can edit schedules
        $user = auth()->user();
        if (!$user->hasRole('super_admin') && !$user->hasRole('head_of_lab')) {
            abort(403, 'Unauthorized: Hanya Kepala Lab dan Super Admin yang dapat mengedit jadwal.');
        }

        $this->schedule = $schedule;
        $this->laboratory_id = $schedule->laboratory_id;
        $this->lecturer_id = $schedule->lecturer_id;
        $this->course_name = $schedule->course_name;
        $this->class_name = $schedule->class_name;
        $this->year_batch = $schedule->year_batch;
        $this->day_of_week = $schedule->day_of_week;
        // Handle time format, might need H:i
        $this->start_time = \Carbon\Carbon::parse($schedule->start_time)->format('H:i');
        $this->end_time = \Carbon\Carbon::parse($schedule->end_time)->format('H:i');
        $this->participants = $schedule->participants;
        $this->notes = $schedule->notes;
        $this->status = $schedule->status;
    }

    public function update()
    {
        $this->validate();

        // Check for conflicts excluding current schedule
        if (PracticumSchedule::hasConflict(
            $this->laboratory_id,
            $this->day_of_week,
            $this->start_time,
            $this->end_time,
            $this->schedule->id
        )) {
            $this->addError('start_time', 'Jadwal bentrok dengan jadwal lain di laboratorium ini pada hari dan jam yang sama.');
            return;
        }

        $this->schedule->update([
            'laboratory_id' => $this->laboratory_id,
            'lecturer_id' => $this->lecturer_id,
            'course_name' => $this->course_name,
            'class_name' => $this->class_name,
            'year_batch' => $this->year_batch,
            'day_of_week' => $this->day_of_week,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'participants' => $this->participants,
            'notes' => $this->notes,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Schedule updated successfully.');

        return redirect()->route('schedules.index');
    }

    public function render()
    {
        return view('livewire.schedules.edit', [
            'laboratories' => Laboratory::all(),
            'lecturers' => User::where('role', 'lecturer')->get(),
        ]);
    }
}
