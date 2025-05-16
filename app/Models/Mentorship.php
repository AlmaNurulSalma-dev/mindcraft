<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mentorship extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'mentor_id',
        'user_id',
        'course_id',
        'status'
    ];
    
    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class, 'mentor_id');
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}