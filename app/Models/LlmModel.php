<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LlmModel extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name',
        'provider',
        'description',
        'api_endpoint',
        'is_active'
    ];
}