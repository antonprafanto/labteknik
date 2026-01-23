<?php

namespace App\Livewire\Borrowings;

use App\Models\BorrowingRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $requests = BorrowingRequest::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('livewire.borrowings.index', [
            'requests' => $requests,
        ])->layout('layouts.app');
    }
}
