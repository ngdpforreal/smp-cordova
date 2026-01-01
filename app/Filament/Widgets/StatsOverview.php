<?php

namespace App\Filament\Widgets;

use App\Models\Teacher;
use App\Models\Post;
use App\Models\Achievement;
use App\Models\Gallery;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Partner;
use App\Models\Testimonial;

class StatsOverview extends BaseWidget
{
    // Mengatur agar widget ini update otomatis setiap 15 detik (opsional, agar terlihat hidup)
    protected static ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        return [
            // 1. STATISTIK GURU
            Stat::make('Total Pengajar', Teacher::count())
                ->description('Guru & Staff Terdaftar')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary') // Warna Biru Filament
                ->chart([7, 2, 10, 3, 15, 4, 17]), // Dummy chart agar cantik

            // 2. STATISTIK BERITA
            Stat::make('Berita & Artikel', Post::where('status', 'published')->count())
                ->description('Artikel Terbit')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success') // Warna Hijau
                ->chart([15, 4, 10, 2, 12, 4, 12]),

            // 3. STATISTIK PRESTASI
            Stat::make('Prestasi Sekolah', Achievement::count())
                ->description('Piala & Penghargaan')
                ->descriptionIcon('heroicon-m-trophy')
                ->color('warning') // Warna Emas/Kuning
                ->chart([3, 5, 8, 2, 5, 8, 9]),
            
            // 4. STATISTIK GALERI (Opsional jika ingin 4 kolom)
            Stat::make('Galeri Foto', Gallery::count())
                ->description('Dokumentasi Kegiatan')
                ->descriptionIcon('heroicon-m-photo')
                ->color('info') // Warna Biru Muda
                ->chart([15, 4, 10, 2, 12, 4, 12]),
            
            Stat::make('Mitra Strategis', Partner::count())
                ->description('Instansi yang bekerja sama')
                ->descriptionIcon('heroicon-m-hand-raised')
                ->color('danger') // Warna merah marun (danger biasanya merah di Filament)
                ->chart([3, 2, 5, 3, 4, 6, 8]),
            
            Stat::make('Total Testimoni', Testimonial::count())
                ->description('Ulasan Wali Murid')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('info') // Warna Biru
                ->chart([4, 5, 3, 6, 8, 5, 9]),
        ];
    }
}