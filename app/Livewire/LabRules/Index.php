<?php

namespace App\Livewire\LabRules;

use App\Models\LabRule;
use Livewire\Component;

class Index extends Component
{
    public $rule;

    public function mount()
    {
        $this->rule = LabRule::getActive();
    }

    public function render()
    {
        return view('livewire.lab-rules.index')
            ->layout('layouts.app');
    }
}
