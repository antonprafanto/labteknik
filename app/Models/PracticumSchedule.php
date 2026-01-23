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
        'schedule_date',
        'start_time',
        'end_time',
        'participants',
        'status',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'schedule_date' => 'date',
        // 'start_time' => 'datetime', // Time casting might need format depending on usage
        // 'end_time' => 'datetime',
    ];

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

    public static function hasConflict($laboratoryId, $date, $startTime, $endTime, $ignoreId = null)
    {
        return self::where('laboratory_id', $laboratoryId)
            ->whereDate('schedule_date', $date)
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
