<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class AiGeneratedContent extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'content_type',
        'title',
        'content',
        'prompt',
        'course_id',
        'unit_id',
        'created_by',
        'is_published'
    ];
    
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}