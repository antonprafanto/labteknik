<?php

namespace App\Livewire\Borrowings;

use App\Models\BorrowingRequest;
use App\Models\BorrowingItem;
use App\Models\InventoryItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $borrow_date;
    public $return_date;
    public $purpose;
    public $participants = 0;
    public $phone;
    public $address;
    public $proof_document;
    public $search = '';
    public $selectedItems = [];

    protected $rules = [
        'borrow_date' => 'required|date|after_or_equal:today',
        'return_date' => 'required|date|after_or_equal:borrow_date',
        'purpose' => 'required|string',
        'participants' => 'required|integer|min:0',
        'phone' => 'required|string|max:20',
        'address' => 'required|string',
        'proof_document' => 'required|file|mimes:pdf|max:2048',
        'selectedItems' => 'required|array|min:1',
        'selectedItems.*.id' => 'required|exists:inventory_items,id',
        'selectedItems.*.quantity' => 'required|integer|min:1',
    ];

    protected $messages = [
        'proof_document.required' => 'Bukti surat peminjaman wajib diupload.',
        'proof_document.mimes' => 'File harus berformat PDF.',
        'proof_document.max' => 'Ukuran file maksimal 2MB.',
    ];

    public function addItem($itemId)
    {
        $item = InventoryItem::find($itemId);
        if ($item && !collect($this->selectedItems)->contains('id', $itemId)) {
            $this->selectedItems[] = [
                'id' => $item->id,
                'name' => $item->name,
                'available' => $item->available_quantity,
                'quantity' => 1,
            ];
        }
    }

    public function removeItem($index)
    {
        unset($this->selectedItems[$index]);
        $this->selectedItems = array_values($this->selectedItems);
    }

    public function save()
    {
        $this->validate();

        // Check availability again before saving
        foreach ($this->selectedItems as $itemData) {
            $item = InventoryItem::find($itemData['id']);
            if ($item->available_quantity < $itemData['quantity']) {
                $this->addError('selectedItems', "Insufficient quantity for item: {$item->name}");
                return;
            }
        }

        $requestNumber = 'BR-' . date('Ymd') . '-' . Str::upper(Str::random(5));

        // Store the proof document
        $proofDocumentPath = $this->proof_document->store('borrowing_documents', 'public');

        $borrowing = BorrowingRequest::create([
            'request_number' => $requestNumber,
            'user_id' => Auth::id(),
            'borrow_date' => $this->borrow_date,
            'return_date' => $this->return_date,
            'purpose' => $this->purpose,
            'participants' => $this->participants,
            'phone' => $this->phone,
            'address' => $this->address,
            'proof_document' => $proofDocumentPath,
            'status' => 'pending',
        ]);

        foreach ($this->selectedItems as $itemData) {
            BorrowingItem::create([
                'borrowing_request_id' => $borrowing->id,
                'inventory_item_id' => $itemData['id'],
                'quantity' => $itemData['quantity'],
                'condition_before' => InventoryItem::find($itemData['id'])->condition,
            ]);
            
            // Note: We don't decrement available_quantity here yet. 
            // It should be done upon approval or when the item is actually taken.
            // For now, let's assume availability is checked but stock is reserved only on approval.
        }

        return redirect()->route('borrowings.index');
    }

    public function render()
    {
        $availableItems = InventoryItem::where('status', 'available')
            ->where('available_quantity', '>', 0)
            ->when($this->search, function($query) {
                $query->where('name', 'like', "%{$this->search}%")
                      ->orWhere('code', 'like', "%{$this->search}%");
            })
            ->take(10)
            ->get();

        return view('livewire.borrowings.create', [
            'availableItems' => $availableItems
        ])->layout('layouts.app');
    }
}
