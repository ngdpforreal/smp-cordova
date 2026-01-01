<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Achievement extends Model
{
    use HasTranslations;
    public $translatable = ['title', 'description'];
    protected $fillable = [
        'title',
        'recipient',
        'rank',
        'level',
        'year',
        'description',
        'image',
    ];
}