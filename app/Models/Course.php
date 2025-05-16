<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name',
        'category_id',
        'price',
        'image',
        'description',
        'slug'
    ];
    
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }
    
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }
    
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
    
    public function courseRecommenders(): HasMany
    {
        return $this->hasMany(CourseRecommender::class);
    }
    
    public function aiGeneratedContents(): HasMany
    {
        return $this->hasMany(AiGeneratedContent::class);
    }
    
    public function insightReports(): HasMany
    {
        return $this->hasMany(InsightReport::class);
    }
    
    public function learningPathItems(): HasMany
    {
        return $this->hasMany(LearningPathItem::class);
    }
    
    public function mentorships(): HasMany
    {
        return $this->hasMany(Mentorship::class);
    }
    
    public function userQuestions(): HasMany
    {
        return $this->hasMany(UserQuestion::class);
    }
}