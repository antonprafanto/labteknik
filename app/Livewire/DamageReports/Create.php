<?php

namespace App\Livewire\DamageReports;

use App\Models\DamageReport;
use App\Models\InventoryItem;
use App\Models\User;
use App\Mail\NewDamageReport;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $inventory_item_id;
    public $damage_type;
    public $description;
    public $image;

    protected $rules = [
        'inventory_item_id' => 'required|exists:inventory_items,id',
        'damage_type' => 'required|in:ringan,sedang,berat,total',
        'description' => 'required|string|min:10',
        'image' => 'nullable|image|max:2048', // 2MB Max
    ];

    public function save()
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('damage-reports', 'public');
        }

        $report = DamageReport::create([
            'inventory_item_id' => $this->inventory_item_id,
            'reporter_id' => auth()->id(),
            'damage_type' => $this->damage_type,
            'description' => $this->description,
            'image_path' => $imagePath,
            'status' => 'reported',
        ]);

        // Send Email Notification to Admins and Head of Lab
        $recipients = User::whereIn('role', ['super_admin', 'head_of_lab'])->get();

        foreach ($recipients as $recipient) {
            if ($recipient->email) {
                Mail::to($recipient->email)->send(new NewDamageReport($report));
            }
            // Send Database Notification
            $recipient->notify(new \App\Notifications\NewDamageReport($report));
        }

        session()->flash('message', 'Damage report submitted successfully.');

        return redirect()->route('damage-reports.index');
    }

    public function render()
    {
        $items = InventoryItem::orderBy('name')->get();

        return view('livewire.damage-reports.create', [
            'items' => $items,
        ]);
    }
}
