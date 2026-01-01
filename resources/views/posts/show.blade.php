@extends('layouts.app')

@section('title', $post->getTranslation('title', app()->getLocale()))

@section('content')
    <section class="py-16 bg-white min-h-screen">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-12">
                
                {{-- KOLOM KIRI (KONTEN UTAMA) --}}
                <div class="lg:w-2/3">
                    {{-- 1. Breadcrumb (SUDAH BENAR) --}}
                    <div class="flex items-center text-sm text-gray-500 mb-6 gap-2 flex-wrap">
                        <a href="{{ url('/') }}" class="hover:text-yayasan transition">{{ __('Beranda') }}</a>
                        <span class="text-gray-300">/</span>
                        <a href="{{ route('posts.index') }}" class="hover:text-yayasan transition">{{ __('Berita') }}</a>
                        <span class="text-gray-300">/</span>
                        <a href="{{ route('posts.index', ['category' => $post->category]) }}" class="hover:text-yayasan transition text-yayasan font-semibold">
                            {{ __('Kategori ' . $post->category) }}
                        </a>
                    </div>

                    <h1 class="text-3xl md:text-5xl font-serif font-bold text-gray-900 mb-6 leading-tight">
                        {{ $post->getTranslation('title', app()->getLocale()) }}
                    </h1>

                    <div class="flex flex-wrap items-center gap-6 text-sm text-gray-500 mb-8 border-b border-gray-100 pb-8">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{-- Format Tanggal (Otomatis menyesuaikan bahasa sistem) --}}
                            <span>{{ $post->published_at ? $post->published_at->translatedFormat('d F Y') : $post->created_at->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            {{-- 2. Meta Penulis (Diterjemahkan) --}}
                            <span>{{ __('Oleh Admin') }}</span>
                        </div>
                         <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            {{-- Meta Views --}}
                            <span>{{ __('Dilihat') }} {{ $post->views }} {{ __('Kali') }}</span>
                        </div>
                    </div>

                    @if($post->image)
                        <div class="rounded-2xl overflow-hidden mb-10 shadow-lg border border-gray-100">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->getTranslation('title', app()->getLocale()) }}" class="w-full h-auto object-cover">
                        </div>
                    @endif

                    <div class="prose prose-lg prose-red max-w-none text-gray-700 leading-relaxed">
                        @php
                            $content = $post->getTranslation('content', app()->getLocale());
                            if (is_array($content)) {
                                $content = json_encode($content); 
                            } elseif (is_null($content)) {
                                $content = '';
                            }
                        @endphp
                        {!! \App\Helpers\TiptapParser::toHtml($content) !!}
                    </div>

                    <div class="mt-12 pt-8 border-t border-gray-100">
                        {{-- 3. Label Bagikan (Diterjemahkan) --}}
                        <span class="font-bold text-gray-900 block mb-4">{{ __('Bagikan') }}:</span>
                        <div class="flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="px-5 py-2.5 bg-[#1877F2] text-white rounded-lg text-sm font-bold hover:opacity-90 transition flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.791-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                Facebook
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($post->getTranslation('title', app()->getLocale()) . ' ' . request()->fullUrl()) }}" target="_blank" class="px-5 py-2.5 bg-[#25D366] text-white rounded-lg text-sm font-bold hover:opacity-90 transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                                WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN (SIDEBAR) --}}
                <div class="lg:w-1/3 space-y-8">
                    
                    {{-- WIDGET PENCARIAN --}}
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200">
                        {{-- 4. Judul Pencarian (Menggunakan Placeholder yang sama) --}}
                        <h3 class="font-serif font-bold text-xl mb-4 text-yayasan">{{ __('Cari Berita Placeholder') }}</h3>
                        <form action="{{ route('posts.index') }}" method="GET" class="relative">
                            {{-- 5. Placeholder Input --}}
                            <input type="text" name="search" placeholder="{{ __('Cari Berita Placeholder') }}" class="w-full pl-4 pr-10 py-3 rounded-lg border-gray-200 focus:border-gold focus:ring-gold transition text-sm">
                            <button type="submit" class="absolute right-3 top-3 text-gray-400 hover:text-yayasan transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </button>
                        </form>
                    </div>

                    {{-- WIDGET BERITA LAINNYA --}}
                    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                        <h3 class="font-serif font-bold text-xl mb-6 text-yayasan flex items-center gap-2">
                            <span class="w-1 h-6 bg-gold rounded-full"></span>
                            {{-- 6. Judul Widget --}}
                            {{ __('Berita Lainnya') }}
                        </h3>
                        <div class="space-y-6">
                            @foreach($related_posts as $related)
                                <a href="{{ route('posts.show', $related->slug) }}" class="flex gap-4 group">
                                    <div class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden bg-gray-200 relative">
                                        @if($related->image)
                                            <img src="{{ asset('storage/' . $related->image) }}" 
                                            alt="{{ $related->getTranslation('title', app()->getLocale()) }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-yayasan/5 text-yayasan">
                                                <svg class="w-8 h-8 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        {{-- 7. Kategori di Berita Lain (PENTING: Agar filter bahasa konsisten) --}}
                                        <span class="text-[10px] font-bold text-gold uppercase tracking-wider block mb-1">
                                            {{ __('Kategori ' . $related->category) }}
                                        </span>
                                        <h4 class="font-bold text-gray-800 text-sm leading-snug group-hover:text-yayasan transition line-clamp-2">
                                            {{ $related->getTranslation('title', app()->getLocale()) }}
                                        </h4>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- WIDGET PPDB --}}
                    <div class="bg-yayasan text-white p-8 rounded-2xl text-center relative overflow-hidden shadow-lg group">
                        <div class="absolute inset-0 opacity-10 transition duration-700 group-hover:scale-110" style="background-image: radial-gradient(#F4C430 1px, transparent 1px); background-size: 10px 10px;"></div>
                        
                        {{-- 8. Teks Widget PPDB --}}
                        <h3 class="font-serif font-bold text-2xl mb-2 relative z-10">{{ __('Widget PPDB Title') }}</h3>
                        <p class="text-sm text-gray-200 mb-6 relative z-10 leading-relaxed">
                            {{ __('Widget PPDB Desc') }}
                        </p>
                        <a href="https://ppdb.ponpesmiha.online/" target="_blank" class="inline-block px-8 py-3 bg-gold text-yayasan-dark font-bold rounded-full hover:bg-white hover:text-yayasan transition-all relative z-10 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            {{ __('Daftar Sekarang') }}
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .prose img {
        margin-top: 1em;
        margin-bottom: 1em;
        display: inline-block;
        height: auto;
    }
    .prose .grid-layout {
        display: grid;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    .prose .grid-layout.grid-cols-2 { grid-template-columns: repeat(2, 1fr); }
    .prose .grid-layout.grid-cols-3 { grid-template-columns: repeat(3, 1fr); }
</style>
@endpush