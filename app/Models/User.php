<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nip_nim',
        'phone',
        'study_program',
        'avatar_path',
        'is_active',
        'laboratory_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function managedLaboratories()
    {
        return $this->hasMany(Laboratory::class, 'head_lab_id');
    }

    public function borrowingRequests()
    {
        return $this->hasMany(BorrowingRequest::class);
    }

    public function approvedBorrowings()
    {
        return $this->hasMany(BorrowingRequest::class, 'approved_by');
    }

    public function damageReports()
    {
        return $this->hasMany(DamageReport::class, 'reporter_id');
    }

    public function repairedDamages()
    {
        return $this->hasMany(DamageReport::class, 'repaired_by');
    }

    public function practicumSchedules()
    {
        return $this->hasMany(PracticumSchedule::class, 'lecturer_id');
    }

    public function maintenanceLogs()
    {
        return $this->hasMany(MaintenanceLog::class, 'technician_id');
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function isAdmin(): bool
    {
        return $this->role === 'super_admin';
    }
}
