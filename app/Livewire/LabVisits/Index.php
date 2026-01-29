<?php

namespace App\Livewire\LabVisits;

use App\Models\Laboratory;
use App\Models\LabVisit;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Response;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $laboratoryFilter = '';
    public $visitorTypeFilter = '';
    public $dateFrom = '';
    public $dateTo = '';
    public $laboratories = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'laboratoryFilter' => ['except' => ''],
        'visitorTypeFilter' => ['except' => ''],
    ];

    public function mount()
    {
        $this->laboratories = Laboratory::orderBy('name')->get();
        $this->dateFrom = now()->startOfMonth()->format('Y-m-d');
        $this->dateTo = now()->format('Y-m-d');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function exportCsv()
    {
        $visits = $this->getVisitsQuery()->get();

        $csvData = [];
        $csvData[] = ['No', 'Tanggal', 'Nama', 'NIM/NIP', 'Prodi', 'Tipe', 'Laboratorium', 'Tujuan', 'Aktivitas', 'Check-In', 'Check-Out', 'Durasi (menit)'];

        foreach ($visits as $index => $visit) {
            $csvData[] = [
                $index + 1,
                $visit->check_in_time->format('Y-m-d'),
                $visit->visitor_name,
                $visit->nim_nip,
                $visit->study_program ?? '-',
                $visit->getVisitorTypeLabel(),
                $visit->laboratory->name,
                $visit->purpose,
                $visit->activity ?? '-',
                $visit->check_in_time->format('H:i'),
                $visit->check_out_time ? $visit->check_out_time->format('H:i') : '-',
                $visit->duration_minutes ?? '-',
            ];
        }

        $filename = 'kunjungan_lab_' . now()->format('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($csvData) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    protected function getVisitsQuery()
    {
        return LabVisit::query()
            ->with('laboratory')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('visitor_name', 'like', '%' . $this->search . '%')
                      ->orWhere('nim_nip', 'like', '%' . $this->search . '%')
                      ->orWhere('study_program', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->laboratoryFilter, fn($q) => $q->where('laboratory_id', $this->laboratoryFilter))
            ->when($this->visitorTypeFilter, fn($q) => $q->where('visitor_type', $this->visitorTypeFilter))
            ->when($this->dateFrom, fn($q) => $q->whereDate('check_in_time', '>=', $this->dateFrom))
            ->when($this->dateTo, fn($q) => $q->whereDate('check_in_time', '<=', $this->dateTo))
            ->orderBy('check_in_time', 'desc');
    }

    public function getStatistics()
    {
        $query = LabVisit::query()
            ->when($this->laboratoryFilter, fn($q) => $q->where('laboratory_id', $this->laboratoryFilter))
            ->when($this->dateFrom, fn($q) => $q->whereDate('check_in_time', '>=', $this->dateFrom))
            ->when($this->dateTo, fn($q) => $q->whereDate('check_in_time', '<=', $this->dateTo));

        return [
            'total' => $query->count(),
            'today' => LabVisit::whereDate('check_in_time', today())->count(),
            'mahasiswa' => (clone $query)->where('visitor_type', 'mahasiswa')->count(),
            'dosen' => (clone $query)->where('visitor_type', 'dosen')->count(),
            'staff' => (clone $query)->where('visitor_type', 'staff')->count(),
            'tamu' => (clone $query)->where('visitor_type', 'tamu')->count(),
            'not_checked_out' => LabVisit::whereNull('check_out_time')->count(),
        ];
    }

    public function render()
    {
        return view('livewire.lab-visits.index', [
            'visits' => $this->getVisitsQuery()->paginate(15),
            'statistics' => $this->getStatistics(),
        ])->layout('layouts.app');
    }
}
