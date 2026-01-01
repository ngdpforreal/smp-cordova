<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class GalleryController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale(); // Ambil bahasa aktif (id/en)

        // 1. Ambil Gallery & Format ke Object Standar
        $galleries = Gallery::latest()->get()->map(function ($item) use ($locale) {
            return (object) [
                'id' => $item->id,
                // Terjemahkan langsung di sini
                'title' => $item->getTranslation('title', $locale),
                'description' => $item->getTranslation('description', $locale),
                'file_path' => $item->file_path,
                'category' => $item->category,
                'created_at' => $item->created_at,
            ];
        });

        // 2. Ambil Prestasi & Format ke Object Standar
        $achievements = Achievement::latest()->get()->map(function ($item) use ($locale) {
            
            $translatedTitle = $item->getTranslation('title', $locale);
            $recipientName = $item->recipient;
            // Ambil Deskripsi Asli
            $translatedDesc = $item->getTranslation('description', $locale); 
            
            // Format Keterangan Tambahan (Tingkat & Tahun)
            $metaInfo = 'Tingkat ' . $item->level . ' - Tahun ' . $item->year;

            return (object) [
                'id' => 'ach-' . $item->id,
                'title' => $translatedTitle . ' (' . $recipientName . ')',
                
                // GABUNGKAN: Deskripsi Asli + Info Tambahan
                // Jika ada deskripsi, tampilkan. Jika tidak, hanya tampilkan info tingkat.
                'description' => $translatedDesc ? ($translatedDesc . ' (' . $metaInfo . ')') : $metaInfo,
                
                'file_path' => $item->image,
                'category' => 'prestasi',
                'created_at' => $item->created_at,
            ];
        });

        // 3. Gabungkan & Urutkan
        $mergedGalleries = $galleries->concat($achievements)->sortByDesc('created_at');

        // 4. Pagination Manual
        $perPage = 9;
        $currentPage = Paginator::resolveCurrentPage() ?: 1;
        $currentItems = $mergedGalleries->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginatedItems = new LengthAwarePaginator(
            $currentItems,
            $mergedGalleries->count(),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath(), 'query' => request()->query()]
        );
        
        return view('galleries.index', ['galleries' => $paginatedItems]);
    }
}