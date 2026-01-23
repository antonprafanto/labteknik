<?php

namespace App\Livewire\DamageReports;

use App\Models\DamageReport;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $user = auth()->user();
        $query = DamageReport::with(['inventoryItem', 'reporter'])
            ->when($this->search, function ($q) {
                $q->whereHas('inventoryItem', function ($subQ) {
                    $subQ->where('name', 'like', '%' . $this->search . '%')
                         ->orWhere('code', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter, function ($q) {
                $q->where('status', $this->statusFilter);
            });

        // Role-based visibility
        if (!$user->hasRole('super_admin') && !$user->hasRole('head_of_lab') && !$user->hasRole('lab_assistant')) {
            $query->where('reporter_id', $user->id);
        }

        $reports = $query->latest()->paginate(10);

        return view('livewire.damage-reports.index', [
            'reports' => $reports,
        ]);
    }
}
