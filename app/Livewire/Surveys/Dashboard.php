<?php

namespace App\Livewire\Surveys;

use App\Models\Laboratory;
use App\Models\LabSatisfactionSurvey;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $laboratoryFilter = '';
    public $dateFrom = '';
    public $dateTo = '';
    public $laboratories = [];

    public function mount()
    {
        $this->laboratories = Laboratory::orderBy('name')->get();
        $this->dateFrom = now()->subMonths(3)->format('Y-m-d');
        $this->dateTo = now()->format('Y-m-d');
    }

    public function getOverallStats()
    {
        $query = LabSatisfactionSurvey::query()
            ->when($this->laboratoryFilter, fn($q) => $q->where('laboratory_id', $this->laboratoryFilter))
            ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo, fn($q) => $q->whereDate('created_at', '<=', $this->dateTo));

        return [
            'total_surveys' => $query->count(),
            'avg_overall' => round($query->avg('rating_overall') ?? 0, 2),
            'avg_cleanliness' => round($query->avg('rating_cleanliness') ?? 0, 2),
            'avg_service' => round($query->avg('rating_service') ?? 0, 2),
            'avg_facilities' => round($query->avg('rating_facilities') ?? 0, 2),
            'avg_equipment' => round($query->avg('rating_equipment') ?? 0, 2),
            'avg_comfort' => round($query->avg('rating_comfort') ?? 0, 2),
            'avg_safety' => round($query->avg('rating_safety') ?? 0, 2),
        ];
    }

    public function getLabRatings()
    {
        return Laboratory::select('laboratories.id', 'laboratories.name')
            ->leftJoin('lab_satisfaction_surveys', 'laboratories.id', '=', 'lab_satisfaction_surveys.laboratory_id')
            ->when($this->dateFrom, fn($q) => $q->whereDate('lab_satisfaction_surveys.created_at', '>=', $this->dateFrom))
            ->when($this->dateTo, fn($q) => $q->whereDate('lab_satisfaction_surveys.created_at', '<=', $this->dateTo))
            ->groupBy('laboratories.id', 'laboratories.name')
            ->selectRaw('COUNT(lab_satisfaction_surveys.id) as total_surveys')
            ->selectRaw('ROUND(AVG(lab_satisfaction_surveys.rating_overall), 2) as avg_rating')
            ->orderByDesc('avg_rating')
            ->get();
    }

    public function getRecentSuggestions()
    {
        return LabSatisfactionSurvey::with('laboratory')
            ->whereNotNull('suggestions')
            ->when($this->laboratoryFilter, fn($q) => $q->where('laboratory_id', $this->laboratoryFilter))
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
    }

    public function getRatingDistribution()
    {
        $distribution = LabSatisfactionSurvey::query()
            ->when($this->laboratoryFilter, fn($q) => $q->where('laboratory_id', $this->laboratoryFilter))
            ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo, fn($q) => $q->whereDate('created_at', '<=', $this->dateTo))
            ->selectRaw('rating_overall, COUNT(*) as count')
            ->groupBy('rating_overall')
            ->orderBy('rating_overall')
            ->pluck('count', 'rating_overall')
            ->toArray();

        // Ensure all ratings 1-5 exist
        for ($i = 1; $i <= 5; $i++) {
            if (!isset($distribution[$i])) {
                $distribution[$i] = 0;
            }
        }
        ksort($distribution);

        return $distribution;
    }

    public function render()
    {
        return view('livewire.surveys.dashboard', [
            'overallStats' => $this->getOverallStats(),
            'labRatings' => $this->getLabRatings(),
            'recentSuggestions' => $this->getRecentSuggestions(),
            'ratingDistribution' => $this->getRatingDistribution(),
        ])->layout('layouts.app');
    }
}
