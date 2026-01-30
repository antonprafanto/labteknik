<?php

namespace App\Livewire\LabRules;

use App\Models\LabRule;
use Livewire\Component;

class Edit extends Component
{
    public $ruleId;
    public $title;
    public $content;
    public $is_active = true;

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'is_active' => 'boolean',
    ];

    public function mount()
    {
        $rule = LabRule::getActive() ?? new LabRule([
            'title' => 'Tata Tertib Laboratorium',
            'content' => '',
            'is_active' => true,
        ]);

        $this->ruleId = $rule->id;
        $this->title = $rule->title;
        $this->content = $rule->content;
        $this->is_active = $rule->is_active;
    }

    public function save()
    {
        $this->validate();

        $rule = $this->ruleId 
            ? LabRule::find($this->ruleId)
            : new LabRule();

        $rule->fill([
            'title' => $this->title,
            'content' => $this->content,
            'is_active' => $this->is_active,
            'updated_by' => auth()->id(),
        ]);

        $rule->save();

        session()->flash('message', 'Tata tertib berhasil disimpan.');

        return redirect()->route('admin.lab-rules.index');
    }

    public function render()
    {
        return view('livewire.lab-rules.edit')
            ->layout('layouts.app');
    }
}
