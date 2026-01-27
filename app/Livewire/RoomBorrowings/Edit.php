<?php

namespace App\Livewire\RoomBorrowings;

use App\Models\RoomBorrowing;
use App\Models\Room;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public RoomBorrowing $roomBorrowing;
    
    public $room_id;
    public $start_datetime;
    public $end_datetime;
    public $purpose;
    public $notes;
    
    // Borrower info
    public $borrower_name;
    public $nim_nip;
    public $study_program;
    public $phone;
    public $address;

    public function mount(RoomBorrowing $roomBorrowing)
    {
        // Only allow editing if status is pending and user is the owner
        if ($roomBorrowing->status !== 'pending' || $roomBorrowing->user_id !== Auth::id()) {
            return redirect()->route('room-borrowings.index')
                ->with('error', 'Anda tidak dapat mengedit peminjaman ini.');
        }

        $this->roomBorrowing = $roomBorrowing;
        $this->room_id = $roomBorrowing->room_id;
        $this->start_datetime = $roomBorrowing->start_datetime->format('Y-m-d\TH:i');
        $this->end_datetime = $roomBorrowing->end_datetime->format('Y-m-d\TH:i');
        $this->purpose = $roomBorrowing->purpose;
        $this->notes = $roomBorrowing->notes ?? '';
        
        $this->borrower_name = $roomBorrowing->borrower_name;
        $this->nim_nip = $roomBorrowing->nim_nip;
        $this->study_program = $roomBorrowing->study_program;
        $this->phone = $roomBorrowing->phone;
        $this->address = $roomBorrowing->address;
    }

    protected $rules = [
        'room_id' => 'required|exists:rooms,id',
        'start_datetime' => 'required|date|after_or_equal:now',
        'end_datetime' => 'required|date|after:start_datetime',
        'purpose' => 'required|string',
        'notes' => 'nullable|string',
        'borrower_name' => 'required|string|max:255',
        'nim_nip' => 'required|string|max:50',
        'study_program' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string',
    ];

    public function save()
    {
        $this->validate();

        // Check if duration exceeds 7 days
        $start = new \DateTime($this->start_datetime);
        $end = new \DateTime($this->end_datetime);
        $diff = $start->diff($end);
        
        if ($diff->days > 7) {
            $this->addError('end_datetime', 'Durasi peminjaman maksimal 7 hari.');
            return;
        }

        $room = Room::find($this->room_id);

        // Check if room is available
        if ($room->status !== 'available') {
            $this->addError('room_id', 'Ruangan tidak tersedia. Status: ' . $room->status);
            return;
        }

        // Check for overlapping bookings (exclude current booking)
        if (!$room->isAvailableForTimeRange($this->start_datetime, $this->end_datetime, $this->roomBorrowing->id)) {
            $this->addError('start_datetime', 'Ruangan sudah dibooking pada waktu tersebut.');
            return;
        }

        $this->roomBorrowing->update([
            'room_id' => $this->room_id,
            'borrower_name' => $this->borrower_name,
            'nim_nip' => $this->nim_nip,
            'study_program' => $this->study_program,
            'phone' => $this->phone,
            'address' => $this->address,
            'start_datetime' => $this->start_datetime,
            'end_datetime' => $this->end_datetime,
            'purpose' => $this->purpose,
            'notes' => $this->notes,
        ]);

        session()->flash('message', 'Peminjaman ruangan berhasil diperbarui.');

        return redirect()->route('room-borrowings.index');
    }

    public function render()
    {
        $rooms = Room::where('status', 'available')->orderBy('name')->get();

        return view('livewire.room-borrowings.edit', [
            'rooms' => $rooms,
        ])->layout('layouts.app');
    }
}
