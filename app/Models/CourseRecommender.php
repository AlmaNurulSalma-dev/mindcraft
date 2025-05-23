<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
class CourseRecommender extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'matching_score',
        'reason',
        'is_free',
        'user_id',
        'course_id'
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}