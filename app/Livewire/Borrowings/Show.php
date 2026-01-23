<?php

namespace App\Livewire\Borrowings;

use App\Models\BorrowingRequest;
use Livewire\Component;

class Show extends Component
{
    public BorrowingRequest $borrowingRequest;

    public function mount(BorrowingRequest $item) // Using $item binding as defined in route
    {
        $this->borrowingRequest = $item;
    }

    public function render()
    {
        return view('livewire.borrowings.show')->layout('layouts.app');
    }
}
