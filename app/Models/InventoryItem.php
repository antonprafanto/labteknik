<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'brand',
        'model',
        'description',
        'purchase_year',
        'condition',
        'status',
        'quantity',
        'available_quantity',
        'laboratory_id',
        'category_id',
        'price',
        'image_path',
        'barcode_path',
        'minimum_stock',
        'specifications',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'specifications' => 'array',
        'purchase_year' => 'integer',
    ];

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function category()
    {
        return $this->belongsTo(InventoryCategory::class);
    }

    public function borrowingItems()
    {
        return $this->hasMany(BorrowingItem::class);
    }

    public function damageReports()
    {
        return $this->hasMany(DamageReport::class);
    }

    public function maintenanceLogs()
    {
        return $this->hasMany(MaintenanceLog::class);
    }
}
