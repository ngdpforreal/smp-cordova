<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\AcademicCalendarController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back(); // Kembali ke halaman sebelumnya
})->name('lang.switch');

Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute Berita
Route::get('/berita', [PostController::class, 'index'])->name('posts.index');
Route::get('/berita/{slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

// Rute Profil
Route::prefix('profil')->group(function () {
    Route::get('/sejarah-visi-misi', [ProfileController::class, 'history'])->name('profile.history');
    Route::get('/struktur-organisasi', [ProfileController::class, 'structure'])->name('profile.structure');
    Route::get('/fasilitas', [ProfileController::class, 'facilities'])->name('profile.facilities');
    Route::get('/testimoni', [ProfileController::class, 'testimonials'])->name('profile.testimonials');
    Route::post('/testimoni/kirim', [ProfileController::class, 'storeTestimonial'])->name('profile.testimonials.store');
    // Rute Program Unggulan
    Route::get('/program-unggulan', [ProgramController::class, 'index'])->name('programs.index');
    // Rute Galeri
    Route::get('/galeri', [GalleryController::class, 'index'])->name('galleries.index');
    Route::get('/ekstrakurikuler', [ExtracurricularController::class, 'index'])->name('extracurriculars.index');
    Route::get('/kalender-akademik', [AcademicCalendarController::class, 'index'])->name('academic.index');
});