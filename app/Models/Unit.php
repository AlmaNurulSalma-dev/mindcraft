<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Unit extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'course_id',
        'name',
        'sequence',
        'slug'
    ];
    
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
    
    public function aiGeneratedContents(): HasMany
    {
        return $this->hasMany(AiGeneratedContent::class);
    }
}