<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LabVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'laboratory_id',
        'visitor_name',
        'nim_nip',
        'email',
        'phone',
        'study_program',
        'visitor_type',
        'purpose',
        'activity',
        'check_in_time',
        'check_out_time',
        'duration_minutes',
        'notes',
        'verified_by',
    ];

    protected $casts = [
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
    ];

    // Relationships
    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    // Accessors
    public function getIsCheckedOutAttribute()
    {
        return $this->check_out_time !== null;
    }

    public function getFormattedDurationAttribute()
    {
        if (!$this->duration_minutes) {
            return '-';
        }

        $hours = floor($this->duration_minutes / 60);
        $minutes = $this->duration_minutes % 60;

        if ($hours > 0) {
            return "{$hours} jam {$minutes} menit";
        }
        return "{$minutes} menit";
    }

    public function getVisitorTypeLabel()
    {
        return match($this->visitor_type) {
            'mahasiswa' => 'Mahasiswa',
            'dosen' => 'Dosen',
            'staff' => 'Staff',
            'tamu' => 'Tamu',
            default => $this->visitor_type,
        };
    }

    // Methods
    public function checkOut()
    {
        $this->check_out_time = now();
        $this->duration_minutes = $this->check_in_time->diffInMinutes($this->check_out_time);
        $this->save();
    }

    // Scopes
    public function scopeForLaboratory($query, $laboratoryId)
    {
        return $query->where('laboratory_id', $laboratoryId);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('check_in_time', today());
    }

    public function scopeNotCheckedOut($query)
    {
        return $query->whereNull('check_out_time');
    }

    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('check_in_time', [$startDate, $endDate]);
    }

    public function scopeByVisitorType($query, $type)
    {
        return $query->where('visitor_type', $type);
    }

    // Check for duplicate entry (same NIM, same day, same lab)
    public static function hasDuplicateToday($nimNip, $laboratoryId)
    {
        return self::where('nim_nip', $nimNip)
            ->where('laboratory_id', $laboratoryId)
            ->whereDate('check_in_time', today())
            ->whereNull('check_out_time')
            ->exists();
    }
}
