<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SchoolSetting;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Mengirim data PARTNERS ke layouts.app (Kode Lama Anda)
        // Kita bungkus try-catch agar aman saat migrate fresh
        view()->composer('layouts.app', function ($view) {
            try {
                $partners = \App\Models\Partner::where('is_active', true)
                    ->orderBy('order', 'asc')
                    ->get();
                $view->with('partners', $partners);
            } catch (\Exception $e) {
                // Jika tabel belum ada, kirim collection kosong agar tidak error
                $view->with('partners', collect([]));
            }
        });

        // 2. Mengirim data SETTING ke SEMUA VIEW (Kode Baru untuk Brosur & Footer)
        // Kita gunakan View::share agar variabel $setting tersedia di footer, kontak, dll.
        try {
            // Pengecekan ekstra: Pastikan tabel school_settings sudah ada sebelum query
            if (Schema::hasTable('school_settings')) {
                $setting = SchoolSetting::first();
                View::share('setting', $setting);
            }
        } catch (\Exception $e) {
            // Silent fail agar proses instalasi/migrasi tidak terganggu
        }
    }
}