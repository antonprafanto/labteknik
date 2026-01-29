<?php

namespace App\Livewire\Borrowings;

use App\Models\BorrowingItem;
use App\Models\BorrowingRequest;
use App\Models\DamageReport;
use App\Models\InventoryItem;
use App\Services\ActivityLogger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class ReturnItems extends Component
{
    public BorrowingRequest $borrowingRequest;
    
    public array $returnConditions = [];
    public array $returnNotes = [];
    public array $capturedPhotos = [];
    
    // For damage report
    public array $damageDescriptions = [];
    public array $damageSeverities = [];

    public function mount(BorrowingRequest $borrowingRequest)
    {
        $this->borrowingRequest = $borrowingRequest->load('items.inventoryItem', 'user');
        
        // Check authorization
        $user = Auth::user();
        if (!in_array($user->role, ['super_admin', 'head_of_lab', 'lab_assistant'])) {
            abort(403, 'Unauthorized');
        }
        
        // Head of lab can only process returns for items from their lab
        if ($user->role === 'head_of_lab' && $user->laboratory_id) {
            $hasItemsFromLab = $this->borrowingRequest->items->contains(function ($item) use ($user) {
                return $item->inventoryItem && $item->inventoryItem->laboratory_id === $user->laboratory_id;
            });
            if (!$hasItemsFromLab) {
                abort(403, 'Anda tidak memiliki akses untuk memproses pengembalian ini.');
            }
        }
        
        // Initialize arrays for each item
        foreach ($this->borrowingRequest->items as $item) {
            $this->returnConditions[$item->id] = 'good';
            $this->returnNotes[$item->id] = '';
            $this->capturedPhotos[$item->id] = null;
            $this->damageDescriptions[$item->id] = '';
            $this->damageSeverities[$item->id] = 'medium';
        }
    }

    #[On('photo-captured')]
    public function setCapturedPhoto($data)
    {
        $itemId = $data['itemId'] ?? null;
        $photo = $data['photo'] ?? null;
        
        if ($itemId && $photo) {
            $this->capturedPhotos[$itemId] = $photo;
        }
    }

    #[On('photo-cleared')]
    public function clearPhoto($data)
    {
        $itemId = $data['itemId'] ?? null;
        if ($itemId) {
            $this->capturedPhotos[$itemId] = null;
        }
    }

    protected function savePhoto($base64Image)
    {
        if (!$base64Image) {
            return null;
        }

        $base64 = preg_replace('/^data:image\/\w+;base64,/', '', $base64Image);
        $imageData = base64_decode($base64);
        $filename = 'return_photos/' . Str::random(20) . '.jpg';
        Storage::disk('public')->put($filename, $imageData);

        return $filename;
    }

    public function processReturn()
    {
        // Validate all items have conditions selected
        foreach ($this->borrowingRequest->items as $item) {
            if (empty($this->returnConditions[$item->id])) {
                session()->flash('error', 'Silakan pilih kondisi untuk semua barang.');
                return;
            }
            
            // Validate photo is required
            if (empty($this->capturedPhotos[$item->id])) {
                session()->flash('error', 'Silakan ambil foto bukti untuk semua barang.');
                return;
            }
            
            // If damaged, require description
            if ($this->returnConditions[$item->id] === 'damaged' && empty($this->damageDescriptions[$item->id])) {
                session()->flash('error', 'Silakan isi deskripsi kerusakan untuk barang yang rusak.');
                return;
            }
        }

        $user = Auth::user();

        foreach ($this->borrowingRequest->items as $item) {
            $condition = $this->returnConditions[$item->id];
            $photoPath = $this->savePhoto($this->capturedPhotos[$item->id]);
            
            // Update borrowing item
            $item->update([
                'return_condition' => $condition,
                'condition_after' => $condition,
                'return_photo' => $photoPath,
                'returned_by' => $user->id,
                'returned_at' => now(),
                'notes' => $this->returnNotes[$item->id] ?: $item->notes,
            ]);

            $inventoryItem = $item->inventoryItem;

            if ($condition === 'good') {
                // Restore stock
                $inventoryItem->increment('available_quantity', $item->quantity);
                $inventoryItem->update(['status' => 'available']);
            } elseif ($condition === 'damaged') {
                // Create damage report
                DamageReport::create([
                    'inventory_item_id' => $inventoryItem->id,
                    'reported_by' => $user->id,
                    'description' => $this->damageDescriptions[$item->id],
                    'severity' => $this->damageSeverities[$item->id],
                    'status' => 'pending',
                    'photo' => $photoPath,
                ]);
                
                // Update inventory status to damaged
                $inventoryItem->update([
                    'status' => 'damaged',
                    'condition' => 'damaged',
                ]);
            } elseif ($condition === 'lost') {
                // Mark as lost
                $inventoryItem->update([
                    'status' => 'lost',
                    'condition' => 'lost',
                ]);
            }
        }

        // Update borrowing request status
        $oldStatus = $this->borrowingRequest->status;
        $this->borrowingRequest->update([
            'status' => 'returned',
            'completed_at' => now(),
        ]);

        // Log activity
        ActivityLogger::log('borrowing_returned', $this->borrowingRequest, "Returned by {$user->name}");

        // Send notification to borrower
        if ($this->borrowingRequest->user && $this->borrowingRequest->user->email) {
            Mail::to($this->borrowingRequest->user->email)
                ->send(new \App\Mail\BorrowingStatusUpdated($this->borrowingRequest));
            
            $this->borrowingRequest->user->notify(
                new \App\Notifications\BorrowingStatusUpdated($this->borrowingRequest)
            );
        }

        session()->flash('message', 'Pengembalian berhasil diproses.');
        return redirect()->route('borrowings.approval');
    }

    public function render()
    {
        return view('livewire.borrowings.return-items')->layout('layouts.app');
    }
}
