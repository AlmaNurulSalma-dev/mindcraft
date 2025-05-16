<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'unit_id',
        'title',
        'content_type',
        'content',
        'video_url',
        'sequence',
        'slug'
    ];
    
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    
    public function essaySubmissions(): HasMany
    {
        return $this->hasMany(EssaySubmission::class);
    }
    
    public function userQuestions(): HasMany
    {
        return $this->hasMany(UserQuestion::class);
    }
}