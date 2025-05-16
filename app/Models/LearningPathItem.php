<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LearningPathItem extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'path_id',
        'course_id',
        'sequence',
        'reason'
    ];
    
    public function learningPath(): BelongsTo
    {
        return $this->belongsTo(LearningPath::class, 'path_id');
    }
    
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}