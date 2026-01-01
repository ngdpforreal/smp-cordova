<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['title', 'content'];

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'image',
        'category',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    // Relasi ke User (Penulis)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}