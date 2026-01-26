<?php

namespace App\Livewire\Admin;

use App\Models\Laboratory;
use App\Models\TimeSlot;
use Livewire\Component;

class TimeSlotManager extends Component
{
    public $laboratory_id = null;
    public $is_friday = false;
    public $timeSlotsList = [];
    
    // Form fields
    public $editingSlotId = null;
    public $start_time = '';
    public $end_time = '';
    public $is_break = false;
    public $break_label = '';

    protected $rules = [
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
        'is_break' => 'boolean',
        'break_label' => 'nullable|string|max:100',
    ];

    public function mount()
    {
        $this->loadSlots();
    }

    public function updatedLaboratoryId()
    {
        $this->loadSlots();
    }

    public function updatedIsFriday()
    {
        $this->loadSlots();
    }

    public function loadSlots()
    {
        $query = TimeSlot::active()
            ->where('is_friday', $this->is_friday)
            ->ordered();

        if ($this->laboratory_id) {
            $query->where('laboratory_id', $this->laboratory_id);
        } else {
            $query->whereNull('laboratory_id');
        }

        $this->timeSlotsList = $query->get()->toArray();
    }

    public function createSlot()
    {
        $this->validate();

        $maxOrder = TimeSlot::where('laboratory_id', $this->laboratory_id ?: null)
            ->where('is_friday', $this->is_friday)
            ->max('sort_order') ?? 0;

        TimeSlot::create([
            'laboratory_id' => $this->laboratory_id ?: null,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'is_friday' => $this->is_friday,
            'is_break' => $this->is_break,
            'break_label' => $this->is_break ? $this->break_label : null,
            'sort_order' => $maxOrder + 1,
        ]);

        $this->resetForm();
        $this->loadSlots();
        $this->dispatch('slot-saved');
    }

    public function editSlot($slotId)
    {
        $slot = TimeSlot::find($slotId);
        if ($slot) {
            $this->editingSlotId = $slotId;
            $this->start_time = $slot->start_time->format('H:i');
            $this->end_time = $slot->end_time->format('H:i');
            $this->is_break = $slot->is_break;
            $this->break_label = $slot->break_label ?? '';
        }
    }

    public function updateSlot()
    {
        $this->validate();

        $slot = TimeSlot::find($this->editingSlotId);
        if ($slot) {
            $slot->update([
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'is_break' => $this->is_break,
                'break_label' => $this->is_break ? $this->break_label : null,
            ]);
        }

        $this->resetForm();
        $this->loadSlots();
        $this->dispatch('slot-saved');
    }

    public function deleteSlot($slotId)
    {
        TimeSlot::destroy($slotId);
        $this->loadSlots();
    }

    public function moveUp($slotId)
    {
        $slot = TimeSlot::find($slotId);
        if (!$slot) return;

        $previousSlot = TimeSlot::where('laboratory_id', $slot->laboratory_id)
            ->where('is_friday', $slot->is_friday)
            ->where('sort_order', '<', $slot->sort_order)
            ->orderByDesc('sort_order')
            ->first();

        if ($previousSlot) {
            $tempOrder = $slot->sort_order;
            $slot->sort_order = $previousSlot->sort_order;
            $previousSlot->sort_order = $tempOrder;
            $slot->save();
            $previousSlot->save();
        }

        $this->loadSlots();
    }

    public function moveDown($slotId)
    {
        $slot = TimeSlot::find($slotId);
        if (!$slot) return;

        $nextSlot = TimeSlot::where('laboratory_id', $slot->laboratory_id)
            ->where('is_friday', $slot->is_friday)
            ->where('sort_order', '>', $slot->sort_order)
            ->orderBy('sort_order')
            ->first();

        if ($nextSlot) {
            $tempOrder = $slot->sort_order;
            $slot->sort_order = $nextSlot->sort_order;
            $nextSlot->sort_order = $tempOrder;
            $slot->save();
            $nextSlot->save();
        }

        $this->loadSlots();
    }

    public function copyFromGlobal()
    {
        if (!$this->laboratory_id) return;

        $globalSlots = TimeSlot::whereNull('laboratory_id')
            ->where('is_friday', $this->is_friday)
            ->active()
            ->ordered()
            ->get();

        foreach ($globalSlots as $slot) {
            TimeSlot::create([
                'laboratory_id' => $this->laboratory_id,
                'start_time' => $slot->start_time,
                'end_time' => $slot->end_time,
                'is_friday' => $slot->is_friday,
                'is_break' => $slot->is_break,
                'break_label' => $slot->break_label,
                'sort_order' => $slot->sort_order,
            ]);
        }

        $this->loadSlots();
        $this->dispatch('slot-saved');
    }

    public function resetForm()
    {
        $this->editingSlotId = null;
        $this->start_time = '';
        $this->end_time = '';
        $this->is_break = false;
        $this->break_label = '';
    }

    public function render()
    {
        $laboratories = Laboratory::orderBy('name')->get();

        return view('livewire.admin.time-slot-manager', [
            'laboratories' => $laboratories,
        ])->layout('layouts.app');
    }
}
