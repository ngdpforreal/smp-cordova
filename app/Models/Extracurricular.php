<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Extracurricular extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['name', 'description', 'schedule'];
    protected $fillable = [
        'name',
        'image',
        'description',
        'schedule',
    ];
}