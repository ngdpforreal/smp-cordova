<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Post;
use App\Models\Program;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)->orderBy('order')->get();
        $programs = Program::all();
        
        // BERITA
        $latest_posts = Post::where('status', 'published')
                            ->latest('published_at')
                            ->take(3)
                            ->get();

        // PRESTASI & TESTIMONI
        $achievements = \App\Models\Achievement::latest()->take(4)->get();
        $testimonials = \App\Models\Testimonial::latest()->take(6)->get();

        // TAMBAHAN: AMBIL 4 FASILITAS TERBARU
        // Kita ambil 4 foto untuk mengisi slot Bento Grid di homepage
        $facilities = \App\Models\Gallery::where('category', 'fasilitas')
                        ->latest()
                        ->take(4)
                        ->get();
        $extracurriculars = \App\Models\Extracurricular::all();

        // Jangan lupa kirim variabel '$facilities' ke view
        return view('welcome', compact(
            'sliders', 
            'programs', 
            'latest_posts', 
            'achievements', 
            'testimonials',
            'facilities',
            'extracurriculars'
        ));
    }
}