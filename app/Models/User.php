<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasPermissions;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasPermissions;

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
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
        ];
    }

    // ini buat role checking (helper menthods) (admin, mentor, mentee)
    public function isAdmin(): bool{
        return $this->role === 'admin';
    }
    public function isMentor(): bool{
        return $this->role === 'mentor';
    }
    public function isMentee(): bool{
        return $this->role === 'mentee';
    }




    
    public function studentProfile()
    {
        return $this->hasOne(StudentProfile::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function mentorships()
    {
        return $this->hasMany(Mentorship::class);
    }

    public function questions()
    {
        return $this->hasMany(UserQuestion::class);
    }

    public function canAccessPanel($panel): bool{
        return true;
    }
}
