<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticumSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'laboratory_id',
        'lecturer_id',
        'course_name',
        'class_name',
        'year_batch',
        'day_of_week', // Added
        'schedule_date', // Kept for legacy reference or specific dates if needed
        'start_time',
        'end_time',
        'participants',
        'status',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'schedule_date' => 'date',
        'day_of_week' => 'integer',
    ];

    protected $appends = ['day_name'];

    public function getDayNameAttribute()
    {
        $days = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu',
        ];

        return $days[$this->day_of_week] ?? '-';
    }

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function hasConflict($laboratoryId, $dayOfWeek, $startTime, $endTime, $ignoreId = null)
    {
        return self::where('laboratory_id', $laboratoryId)
            ->where('day_of_week', $dayOfWeek)
            ->where('status', '!=', 'cancelled') // Ignore cancelled schedules
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '>=', $startTime)
                      ->where('start_time', '<', $endTime);
                })
                ->orWhere(function ($q) use ($startTime, $endTime) {
                    $q->where('end_time', '>', $startTime)
                      ->where('end_time', '<=', $endTime);
                })
                ->orWhere(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '<=', $startTime)
                      ->where('end_time', '>=', $endTime);
                });
            })
            ->when($ignoreId, function ($query) use ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            })
            ->exists();
    }
}
