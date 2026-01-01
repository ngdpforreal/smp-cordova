<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasTranslations;
    public $translatable = ['position', 'bio'];
    protected $fillable = [
    'name', 'position', 'type', 'photo', 'bio', 
    'education', 'facebook', 'instagram', 'linkedin', 'cv_file', 'order',
    ];
}