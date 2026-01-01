<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AcademicCalendar extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['title', 'description'];

    // Tambahkan ini untuk mengatasi error MassAssignmentException
    protected $fillable = [
        'title',
        'start_date', // Kita ganti event_date jadi start_date
        'end_date',   // Tambahan baru
        'description',
        'is_holiday',
    ];

    // Agar Laravel otomatis membaca ini sebagai format Tanggal
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_holiday' => 'boolean',
    ];
}