<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LabActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'photo_path',
        'activity_date',
        'lab_activity_category_id',
        'laboratory_id',
        'uploaded_by',
        'is_featured',
    ];

    protected $casts = [
        'activity_date' => 'date',
        'is_featured' => 'boolean',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        // Delete photo when activity is deleted
        static::deleting(function ($activity) {
            if ($activity->photo_path && Storage::disk('public')->exists($activity->photo_path)) {
                Storage::disk('public')->delete($activity->photo_path);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(LabActivityCategory::class, 'lab_activity_category_id');
    }

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Get the photo URL
     */
    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo_path && Storage::disk('public')->exists($this->photo_path)) {
            return asset('storage/' . $this->photo_path);
        }
        return asset('images/placeholder.jpg');
    }

    /**
     * Scope: Featured activities
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope: By category
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('lab_activity_category_id', $categoryId);
    }

    /**
     * Scope: By laboratory
     */
    public function scopeByLaboratory($query, $laboratoryId)
    {
        return $query->where('laboratory_id', $laboratoryId);
    }
}
