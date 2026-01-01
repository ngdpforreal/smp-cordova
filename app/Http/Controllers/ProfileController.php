<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function history()
    {
        $history = Setting::where('key', 'history')->value('value');
        $vision = Setting::where('key', 'vision')->value('value');
        $mission = Setting::where('key', 'mission')->value('value');

        return view('profiles.history', compact('history', 'vision', 'mission'));
    }

    public function structure()
    {
        // Mengambil data guru dikelompokkan
        $pimpinan = Teacher::where('type', 'pimpinan')->orderBy('order')->get();
        $guru = Teacher::where('type', 'guru')->orderBy('order')->get();
        $staff = Teacher::where('type', 'staff')->orderBy('order')->get();

        return view('profiles.structure', compact('pimpinan', 'guru', 'staff'));
    }

    public function facilities()
    {
        // Nanti kita ambil dari tabel galleries kategori fasilitas
        // Untuk sekarang statis dulu atau ambil dari model Gallery jika sudah diisi
        $facilities = \App\Models\Gallery::where('category', 'fasilitas')->get();
        
        return view('profiles.facilities', compact('facilities'));
    }
    public function testimonials()
    {
        // Tambahkan filter is_published = true
        $testimonials = \App\Models\Testimonial::where('is_published', true)
            ->latest()
            ->paginate(9);
        
        return view('profiles.testimonials', compact('testimonials'));
    }
    public function storeTestimonial(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:100',
            'content' => 'required|string|min:10',
            'rating' => 'required|integer|min:1|max:5',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Simpan ke folder yang sama dengan yang didefinisikan di Filament
            $validated['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        // Set default is_published ke false untuk moderasi admin
        $validated['is_published'] = false;

        Testimonial::create($validated);

        return back()->with('success', 'Terima kasih! Testimoni Anda telah terkirim dan akan ditinjau oleh admin sebelum diterbitkan.');
    }
}