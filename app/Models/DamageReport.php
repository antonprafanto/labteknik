<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DamageReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_item_id',
        'reporter_id',
        'damage_type',
        'description',
        'image_path',
        'status',
        'repair_cost',
        'repair_date',
        'repair_notes',
        'repaired_by',
    ];

    protected $casts = [
        'repair_cost' => 'decimal:2',
        'repair_date' => 'date',
    ];

    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class);
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function repairer()
    {
        return $this->belongsTo(User::class, 'repaired_by');
    }
}
