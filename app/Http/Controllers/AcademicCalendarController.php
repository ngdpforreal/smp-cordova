<?php

namespace App\Http\Controllers;

use App\Models\AcademicCalendar;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AcademicCalendarController extends Controller
{
    public function index()
    {
        $events = AcademicCalendar::whereDate('end_date', '>=', now()->startOfYear()) // Ambil yang belum lewat
                    ->orWhereDate('start_date', '>=', now()->startOfYear())
                    ->orderBy('start_date')
                    ->get()
                    ->groupBy(function($date) {
                        return \Carbon\Carbon::parse($date->start_date)->translatedFormat('F Y');
                    });

        return view('academic-calendar.index', compact('events'));
    }
}