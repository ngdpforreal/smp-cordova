<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    // Tentukan kolom mana saja yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'name',
        'logo',
        'website',
        'order',
        'is_active',
    ];
}