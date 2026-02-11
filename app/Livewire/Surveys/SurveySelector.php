<?php

namespace App\Livewire\Surveys;

use App\Models\Laboratory;
use Livewire\Component;

class SurveySelector extends Component
{
    public $laboratories;
    public $isLoading = true;

    public function mount()
    {
        $this->loadLaboratories();
    }

    public function loadLaboratories()
    {
        $this->isLoading = true;
        
        // Get all active laboratories
        $this->laboratories = Laboratory::orderBy('name', 'asc')->get();
        
        $this->isLoading = false;

        // If no laboratories found, redirect to home with message
        if ($this->laboratories->isEmpty()) {
            session()->flash('error', 'Tidak ada laboratorium yang tersedia saat ini.');
            return redirect()->route('welcome');
        }
    }

    public function selectLaboratory($laboratoryId)
    {
        $laboratory = Laboratory::find($laboratoryId);
        
        if (!$laboratory) {
            session()->flash('error', 'Laboratorium tidak ditemukan.');
            return;
        }

        // Redirect to survey form for selected laboratory
        return redirect()->route('surveys.create', ['laboratory' => $laboratory->id]);
    }

    public function render()
    {
        return view('livewire.surveys.selector')
            ->layout('layouts.guest', ['title' => 'Pilih Laboratorium - Survey Kepuasan']);
    }
}
