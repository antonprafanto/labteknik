<?php

namespace App\Livewire\Surveys;

use App\Models\Laboratory;
use App\Models\LabSatisfactionSurvey;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Response;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $laboratoryFilter = '';
    public $dateFrom = '';
    public $dateTo = '';
    public $ratingFilter = '';
    public $laboratories = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'laboratoryFilter' => ['except' => ''],
        'ratingFilter' => ['except' => ''],
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
        $surveys = $this->getSurveysQuery()->get();

        $csvData = [];
        $csvData[] = ['No', 'Tanggal', 'Nama', 'Lab', 'Kebersihan', 'Pelayanan', 'Fasilitas', 'Peralatan', 'Kenyamanan', 'Keamanan', 'Keseluruhan', 'Rata-rata', 'Kritik & Saran'];

        foreach ($surveys as $index => $survey) {
            $csvData[] = [
                $index + 1,
                $survey->created_at->format('Y-m-d H:i'),
                $survey->display_name,
                $survey->laboratory->name,
                $survey->rating_cleanliness,
                $survey->rating_service,
                $survey->rating_facilities,
                $survey->rating_equipment,
                $survey->rating_comfort,
                $survey->rating_safety,
                $survey->rating_overall,
                $survey->average_rating,
                $survey->suggestions ?? '-',
            ];
        }

        $filename = 'survey_kepuasan_' . now()->format('Y-m-d_His') . '.csv';
        
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

    protected function getSurveysQuery()
    {
        return LabSatisfactionSurvey::query()
            ->with(['laboratory', 'user'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas('user', fn($u) => $u->where('name', 'like', '%' . $this->search . '%'))
                      ->orWhere('suggestions', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->laboratoryFilter, fn($q) => $q->where('laboratory_id', $this->laboratoryFilter))
            ->when($this->ratingFilter, function($q) {
                if ($this->ratingFilter === 'low') {
                    $q->where('rating_overall', '<=', 3);
                } elseif ($this->ratingFilter === 'high') {
                    $q->where('rating_overall', '>=', 4);
                }
            })
            ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo, fn($q) => $q->whereDate('created_at', '<=', $this->dateTo))
            ->orderBy('created_at', 'desc');
    }

    public function getStatistics()
    {
        $query = LabSatisfactionSurvey::query()
            ->when($this->laboratoryFilter, fn($q) => $q->where('laboratory_id', $this->laboratoryFilter))
            ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo, fn($q) => $q->whereDate('created_at', '<=', $this->dateTo));

        $total = $query->count();
        
        return [
            'total' => $total,
            'avg_cleanliness' => round($query->avg('rating_cleanliness') ?? 0, 1),
            'avg_service' => round($query->avg('rating_service') ?? 0, 1),
            'avg_facilities' => round($query->avg('rating_facilities') ?? 0, 1),
            'avg_equipment' => round($query->avg('rating_equipment') ?? 0, 1),
            'avg_comfort' => round($query->avg('rating_comfort') ?? 0, 1),
            'avg_safety' => round($query->avg('rating_safety') ?? 0, 1),
            'avg_overall' => round($query->avg('rating_overall') ?? 0, 1),
            'low_ratings' => (clone $query)->where('rating_overall', '<=', 3)->count(),
        ];
    }

    public function render()
    {
        return view('livewire.surveys.index', [
            'surveys' => $this->getSurveysQuery()->paginate(15),
            'statistics' => $this->getStatistics(),
        ])->layout('layouts.app');
    }
}
