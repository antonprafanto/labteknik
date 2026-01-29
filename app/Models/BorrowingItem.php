<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrowing_request_id',
        'inventory_item_id',
        'quantity',
        'condition_before',
        'condition_after',
        'returned_at',
        'notes',
        'return_photo',
        'returned_by',
        'return_condition',
    ];

    protected $casts = [
        'returned_at' => 'datetime',
    ];

    public function borrowingRequest()
    {
        return $this->belongsTo(BorrowingRequest::class);
    }

    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class);
    }

    public function returnedByUser()
    {
        return $this->belongsTo(User::class, 'returned_by');
    }
}
