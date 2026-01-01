<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    // Kolom yang diizinkan untuk diisi
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'is_read',
    ];
    
    // Casting tipe data (opsional, untuk memastikan is_read dianggap boolean)
    protected $casts = [
        'is_read' => 'boolean',
    ];
}