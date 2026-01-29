<?php

namespace App\Livewire\LabVisits;

use App\Models\Laboratory;
use App\Models\LabVisit;
use Livewire\Component;

class CheckIn extends Component
{
    public ?Laboratory $laboratory = null;
    public $laboratoryId = '';
    public $laboratories = [];
    
    public $visitor_name = '';
    public $nim_nip = '';
    public $email = '';
    public $phone = '';
    public $study_program = '';
    public $visitor_type = 'mahasiswa';
    public $purpose = '';
    public $activity = '';
    public $notes = '';

    public $showSuccess = false;
    public $visitId = null;

    protected $rules = [
        'laboratoryId' => 'required|exists:laboratories,id',
        'visitor_name' => 'required|string|max:255',
        'nim_nip' => 'required|string|max:50',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:20',
        'study_program' => 'nullable|string|max:255',
        'visitor_type' => 'required|in:mahasiswa,dosen,staff,tamu',
        'purpose' => 'required|string|max:500',
        'activity' => 'nullable|string|max:255',
    ];

    protected $messages = [
        'laboratoryId.required' => 'Pilih laboratorium yang dikunjungi.',
        'visitor_name.required' => 'Nama wajib diisi.',
        'nim_nip.required' => 'NIM/NIP wajib diisi.',
        'purpose.required' => 'Tujuan kunjungan wajib diisi.',
    ];

    public function mount(?Laboratory $laboratory = null)
    {
        $this->laboratories = Laboratory::where('status', 'active')->orderBy('name')->get();
        
        if ($laboratory && $laboratory->exists) {
            $this->laboratory = $laboratory;
            $this->laboratoryId = $laboratory->id;
        }
    }

    public function checkIn()
    {
        $this->validate();

        // Check for duplicate (same NIM, same lab, same day, not checked out)
        if (LabVisit::hasDuplicateToday($this->nim_nip, $this->laboratoryId)) {
            $this->addError('nim_nip', 'Anda sudah check-in hari ini dan belum check-out. Silakan check-out terlebih dahulu.');
            return;
        }

        $visit = LabVisit::create([
            'laboratory_id' => $this->laboratoryId,
            'visitor_name' => $this->visitor_name,
            'nim_nip' => $this->nim_nip,
            'email' => $this->email,
            'phone' => $this->phone,
            'study_program' => $this->study_program,
            'visitor_type' => $this->visitor_type,
            'purpose' => $this->purpose,
            'activity' => $this->activity,
            'notes' => $this->notes,
            'check_in_time' => now(),
        ]);

        $this->visitId = $visit->id;
        $this->showSuccess = true;
        
        // Reset form
        $this->reset(['visitor_name', 'nim_nip', 'email', 'phone', 'study_program', 'purpose', 'activity', 'notes']);
        $this->visitor_type = 'mahasiswa';
    }

    public function resetForm()
    {
        $this->showSuccess = false;
        $this->visitId = null;
    }

    public function render()
    {
        return view('livewire.lab-visits.check-in')
            ->layout('layouts.guest', ['title' => 'Check-In Kunjungan Lab']);
    }
}
