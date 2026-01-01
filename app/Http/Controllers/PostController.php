<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Menampilkan daftar semua berita
    public function index(Request $request)
    {
        // 1. Mulai Query dasar (hanya yang published)
        $query = Post::where('status', 'published');

        // 2. Cek apakah ada Filter Kategori di URL
        // Jika ada param 'category' DAN isinya bukan 'all'
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // 3. Cek apakah ada Pencarian
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // 4. Eksekusi Query dengan Pagination (tambahkan withQueryString agar filter tidak hilang saat ganti halaman)
        $posts = $query->latest('published_at')
                       ->paginate(9)
                       ->withQueryString();

        return view('posts.index', compact('posts'));
    }

    // Menampilkan detail satu berita
    public function show($slug)
    {
        $post = Post::where('slug', $slug)
                    ->where('status', 'published')
                    ->firstOrFail();

        $related_posts = Post::where('status', 'published')
                             ->where('id', '!=', $post->id)
                             ->latest('published_at')
                             ->take(3)
                             ->get();

        return view('posts.show', compact('post', 'related_posts'));
    }
}