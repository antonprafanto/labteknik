<?php

namespace App\Livewire\ActivityLogs;

use App\Models\ActivityLog;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $logs = ActivityLog::with('user')
            ->latest()
            ->paginate(15);

        return view('livewire.activity-logs.index', [
            'logs' => $logs,
        ])->layout('layouts.app');
    }
}