<?php

namespace App\Livewire\Schedules;

use App\Models\Laboratory;
use App\Models\PracticumSchedule;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $laboratory_id;
    public $lecturer_id;
    public $course_name;
    public $class_name;
    public $schedule_date;
    public $start_time;
    public $end_time;
    public $participants;
    public $notes;

    protected $rules = [
        'laboratory_id' => 'required|exists:laboratories,id',
        'lecturer_id' => 'required|exists:users,id',
        'course_name' => 'required|string|max:255',
        'class_name' => 'required|string|max:100',
        'schedule_date' => 'required|date|after_or_equal:today',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
        'participants' => 'required|integer|min:1',
        'notes' => 'nullable|string',
    ];

    public function mount()
    {
        // Set default values if needed
    }

    public function save()
    {
        $this->validate();

        // Check for conflicts
        if (PracticumSchedule::hasConflict(
            $this->laboratory_id,
            $this->schedule_date,
            $this->start_time,
            $this->end_time
        )) {
            $this->addError('start_time', 'There is a scheduling conflict for this time slot in the selected laboratory.');
            return;
        }

        PracticumSchedule::create([
            'laboratory_id' => $this->laboratory_id,
            'lecturer_id' => $this->lecturer_id,
            'course_name' => $this->course_name,
            'class_name' => $this->class_name,
            'schedule_date' => $this->schedule_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'participants' => $this->participants,
            'notes' => $this->notes,
            'created_by' => auth()->id(),
            'status' => 'scheduled',
        ]);

        session()->flash('message', 'Schedule created successfully.');

        return redirect()->route('schedules.index');
    }

    public function render()
    {
        return view('livewire.schedules.create', [
            'laboratories' => Laboratory::all(),
            'lecturers' => User::where('role', 'lecturer')->get(),
        ]);
    }
}
