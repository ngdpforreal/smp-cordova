<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use HasTranslations;
    public $translatable = ['content', 'role'];
    protected $fillable = [
        'name',
        'role',
        'content',
        'photo',
        'rating',
        'is_published',
    ];
}