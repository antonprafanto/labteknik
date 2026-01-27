<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'capacity',
        'facilities',
        'location',
        'floor',
        'status',
        'photo',
        'description',
        'laboratory_id',
    ];

    protected $casts = [
        'facilities' => 'array',
    ];

    /**
     * Get the laboratory that owns the room
     */
    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    /**
     * Get all borrowings for this room
     */
    public function borrowings()
    {
        return $this->hasMany(RoomBorrowing::class);
    }

    /**
     * Scope to filter only available rooms
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * Check if room is available for a given time range
     */
    public function isAvailableForTimeRange($startDatetime, $endDatetime, $excludeBorrowingId = null)
    {
        if ($this->status !== 'available') {
            return false;
        }

        $query = $this->borrowings()
            ->whereIn('status', ['pending', 'approved'])
            ->where(function ($q) use ($startDatetime, $endDatetime) {
                $q->whereBetween('start_datetime', [$startDatetime, $endDatetime])
                    ->orWhereBetween('end_datetime', [$startDatetime, $endDatetime])
                    ->orWhere(function ($q2) use ($startDatetime, $endDatetime) {
                        $q2->where('start_datetime', '<=', $startDatetime)
                            ->where('end_datetime', '>=', $endDatetime);
                    });
            });

        if ($excludeBorrowingId) {
            $query->where('id', '!=', $excludeBorrowingId);
        }

        return $query->count() === 0;
    }
}
