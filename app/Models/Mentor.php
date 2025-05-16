<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mentor extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name',
        'phone',
        'expertise',
        'qualification'
    ];
    
    public function mentorRecommendations(): HasMany
    {
        return $this->hasMany(MentorRecommendation::class);
    }
    
    public function mentorships(): HasMany
    {
        return $this->hasMany(Mentorship::class);
    }
}