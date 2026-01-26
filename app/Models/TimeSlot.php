<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'laboratory_id',
        'start_time',
        'end_time',
        'is_friday',
        'is_break',
        'break_label',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'is_friday' => 'boolean',
        'is_break' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    /**
     * Get formatted time range
     */
    public function getTimeRangeAttribute(): string
    {
        return $this->start_time->format('H:i') . ' - ' . $this->end_time->format('H:i');
    }

    /**
     * Scope for regular day slots (non-Friday)
     */
    public function scopeRegular($query)
    {
        return $query->where('is_friday', false);
    }

    /**
     * Scope for Friday slots
     */
    public function scopeFriday($query)
    {
        return $query->where('is_friday', true);
    }

    /**
     * Scope for active slots
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for specific lab or global (null)
     */
    public function scopeForLab($query, $labId = null)
    {
        return $query->where(function ($q) use ($labId) {
            $q->where('laboratory_id', $labId)
              ->orWhereNull('laboratory_id');
        });
    }

    /**
     * Get slots ordered by sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
