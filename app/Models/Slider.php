<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasTranslations;
    public $translatable = ['title', 'subtitle', 'button_text', 'button2_text'];
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'button_text',
        'button_link',
        'open_new_tab',
        'button2_text',
        'button2_link',
        'button2_new_tab',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'open_new_tab' => 'boolean',
        'button2_new_tab' => 'boolean',
    ];
}