<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LabSatisfactionSurvey extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'laboratory_id',
        'borrowing_request_id',
        'room_borrowing_id',
        'survey_token',
        'is_anonymous',
        'rating_cleanliness',
        'rating_service',
        'rating_facilities',
        'rating_equipment',
        'rating_comfort',
        'rating_safety',
        'rating_overall',
        'suggestions',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($survey) {
            if (empty($survey->survey_token)) {
                $survey->survey_token = Str::random(64);
            }
        });
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function borrowingRequest()
    {
        return $this->belongsTo(BorrowingRequest::class);
    }

    public function roomBorrowing()
    {
        return $this->belongsTo(RoomBorrowing::class);
    }

    // Accessors
    public function getAverageRatingAttribute()
    {
        $ratings = array_filter([
            $this->rating_cleanliness,
            $this->rating_service,
            $this->rating_facilities,
            $this->rating_equipment,
            $this->rating_comfort,
            $this->rating_safety,
            $this->rating_overall,
        ]);

        return count($ratings) > 0 ? round(array_sum($ratings) / count($ratings), 1) : 0;
    }

    public function getDisplayNameAttribute()
    {
        if ($this->is_anonymous) {
            return 'Anonim';
        }
        return $this->user?->name ?? 'Tidak diketahui';
    }

    // Scopes
    public function scopeForLaboratory($query, $laboratoryId)
    {
        return $query->where('laboratory_id', $laboratoryId);
    }

    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    public function scopeLowRating($query, $threshold = 3)
    {
        return $query->where('rating_overall', '<=', $threshold);
    }
}
