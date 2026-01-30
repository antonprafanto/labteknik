<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'room_number',
        'capacity',
        'area',
        'status',
        'description',
        'head_lab_id',
        'floor_plan_path',
    ];

    protected $casts = [
        'area' => 'decimal:2',
    ];

    public function head()
    {
        return $this->belongsTo(User::class, 'head_lab_id');
    }

    public function inventoryItems()
    {
        return $this->hasMany(InventoryItem::class);
    }

    public function practicumSchedules()
    {
        return $this->hasMany(PracticumSchedule::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function technicians()
    {
        return $this->hasMany(User::class)->where('role', 'lab_assistant');
    }

    public function labVisits()
    {
        return $this->hasMany(LabVisit::class);
    }

    public function satisfactionSurveys()
    {
        return $this->hasMany(LabSatisfactionSurvey::class);
    }

    public function activities()
    {
        return $this->hasMany(LabActivity::class);
    }
}
