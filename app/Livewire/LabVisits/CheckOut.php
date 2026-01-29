<?php

namespace App\Livewire\LabVisits;

use App\Models\LabVisit;
use Livewire\Component;

class CheckOut extends Component
{
    public $nim_nip = '';
    public $showSuccess = false;
    public $visit = null;
    public $activeVisits = [];

    protected $rules = [
        'nim_nip' => 'required|string|max:50',
    ];

    public function search()
    {
        $this->validate();

        $this->activeVisits = LabVisit::where('nim_nip', $this->nim_nip)
            ->whereNull('check_out_time')
            ->with('laboratory')
            ->orderBy('check_in_time', 'desc')
            ->get();

        if ($this->activeVisits->isEmpty()) {
            $this->addError('nim_nip', 'Tidak ditemukan kunjungan aktif dengan NIM/NIP tersebut.');
        }
    }

    public function checkOut($visitId)
    {
        $visit = LabVisit::find($visitId);
        
        if (!$visit || $visit->check_out_time) {
            $this->addError('nim_nip', 'Kunjungan tidak ditemukan atau sudah check-out.');
            return;
        }

        $visit->checkOut();
        $this->visit = $visit->fresh()->load('laboratory');
        $this->showSuccess = true;
        $this->activeVisits = [];
    }

    public function resetForm()
    {
        $this->reset(['nim_nip', 'showSuccess', 'visit', 'activeVisits']);
    }

    public function render()
    {
        return view('livewire.lab-visits.check-out')
            ->layout('layouts.guest', ['title' => 'Check-Out Kunjungan Lab']);
    }
}
