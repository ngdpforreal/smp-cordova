<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Gallery extends Model
{
    use HasTranslations;
    public $translatable = ['title', 'description'];
    protected $fillable = [
        'title',
        'type',
        'file_path',
        'category',
        'description',
    ];
}