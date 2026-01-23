<?php

namespace App\Livewire\Laboratories;

use App\Models\Laboratory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $laboratories = Laboratory::with(['head', 'technicians'])
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('location', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.laboratories.index', [
            'laboratories' => $laboratories,
        ])->layout('layouts.app');
    }
}
