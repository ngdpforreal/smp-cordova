<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolSetting extends Model
{
    protected $fillable = [
        'email', 'phone', 'address', 'maps_embed', 
        'facebook', 'instagram', 'twitter', 'youtube',
        'brochure'
    ];
}