@extends('layouts.app')

@section('title', 'Berita & Artikel')

@section('content')
    <x-header-page 
        :title="__('Informasi Lengkap')"
        :subtitle="__('Deskripsi Berita')"
        :breadcrumb="__('Informasi Lengkap')" 
    />

    <section class="py-16 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4">

            <div class="flex flex-col md:flex-row justify-between items-center gap-6 mb-10 sticky top-[80px] z-30 bg-white/90 backdrop-blur-md px-6 py-4 rounded-2xl shadow-sm border border-gray-100 transition-all duration-300">
                
                <div class="flex flex-wrap justify-center md:justify-start gap-2 w-full md:w-auto overflow-x-auto pb-2 md:pb-0 hide-scrollbar">
                    {{-- Tombol Semua --}}
                    <a href="{{ route('posts.index') }}" 
                       class="px-5 py-2 rounded-lg font-bold text-sm transition-all duration-300 whitespace-nowrap {{ !request('category') || request('category') == 'all' ? 'bg-yayasan text-white shadow-md' : 'text-gray-500 hover:text-yayasan hover:bg-gray-100' }}">
                        {{ __('Semua') }}
                    </a>

                    {{-- Loop Kategori dengan Terjemahan --}}
                    @php
                        // Format: 'Nilai di Database' => 'Kunci di File JSON'
                        $categories = [
                            'Berita'     => 'Kategori Berita',
                            'Artikel'    => 'Kategori Artikel',
                            'Agenda'     => 'Kategori Agenda',
                            'Pengumuman' => 'Kategori Pengumuman'
                        ];
                    @endphp

                    @foreach($categories as $dbValue => $jsonKey)
                        <a href="{{ route('posts.index', array_merge(request()->query(), ['category' => $dbValue])) }}" 
                        class="px-5 py-2 rounded-lg font-bold text-sm transition-all duration-300 whitespace-nowrap {{ request('category') == $dbValue ? 'bg-yayasan text-white shadow-md' : 'text-gray-500 hover:text-yayasan hover:bg-gray-100' }}">
                            {{-- Tampilkan Label hasil terjemahan --}}
                            {{ __($jsonKey) }}
                        </a>
                    @endforeach
                </div>

                <form action="{{ route('posts.index') }}" method="GET" class="relative w-full md:w-72">
                    {{-- Pertahankan kategori saat mencari --}}
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif

                    <input type="text" 
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="{{ __('Cari Berita Placeholder') }}" 
                           class="w-full pl-10 pr-4 py-2.5 bg-gray-100 border-none rounded-xl text-sm focus:ring-2 focus:ring-gold/50 focus:bg-white transition-all duration-300 placeholder-gray-400">
                    
                    <button type="submit" class="absolute left-3 top-2.5 text-gray-400 hover:text-gold transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($posts as $post)
                    <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-gray-100 hover:border-gold/30 transition-all duration-300 group flex flex-col h-full">
                        
                        <div class="h-56 overflow-hidden relative bg-gray-200">
                            <a href="{{ route('posts.show', $post->slug) }}" class="block w-full h-full">
                                @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" 
                                         alt="{{ $post->getTranslation('title', app()->getLocale()) }}" 
                                         loading="lazy"
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-yayasan/5 text-yayasan">
                                        <svg class="w-16 h-16 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                                    </div>
                                @endif
                            </a>
                            
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-white/95 backdrop-blur-sm text-[10px] font-bold uppercase tracking-wider text-yayasan rounded-lg shadow-sm border border-gray-100">
                                    {{ $post->category }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 mb-3 text-xs text-gray-400 font-medium">
                                <svg class="w-4 h-4 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $post->published_at ? $post->published_at->format('d F Y') : $post->created_at->format('d F Y') }}
                            </div>

                            <h3 class="text-lg font-bold text-gray-900 mb-3 leading-snug group-hover:text-yayasan transition-colors line-clamp-2 min-h-[3.5rem]">
                                <a href="{{ route('posts.show', $post->slug) }}">{{ $post->getTranslation('title', app()->getLocale()) }}</a>
                            </h3>

                            <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-3 flex-1">
                                @php
                                    $content = $post->getTranslation('content', app()->getLocale());
                                    if (is_array($content)) {
                                        $content = json_encode($content);
                                    }
                                @endphp
                                {{ Str::limit(\App\Helpers\TiptapParser::toText($post->getTranslation('content', app()->getLocale())), 120) }}
                            </p>

                            <div class="pt-5 border-t border-gray-50 mt-auto flex items-center justify-between">
                                <a href="{{ route('posts.show', $post->slug) }}" class="text-sm font-bold text-gold hover:text-yayasan transition-colors flex items-center gap-1 group/link">
                                    {{ __('Baca Selengkapnya') }}
                                    <svg class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Tidak ditemukan</h3>
                        <p class="text-gray-500 max-w-md mx-auto">
                            Maaf, tidak ada berita yang sesuai dengan kategori atau kata kunci pencarian Anda.
                        </p>
                        @if(request('category') || request('search'))
                            <a href="{{ route('posts.index') }}" class="inline-block mt-6 px-6 py-2 bg-yayasan text-white rounded-full text-sm font-bold hover:bg-gold hover:text-yayasan-dark transition">
                                Reset Filter
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>

            <div class="mt-16 flex justify-center">
                {{-- Gunakan withQueryString agar filter tidak hilang saat pindah halaman --}}
                {{ $posts->withQueryString()->links() }}
            </div>
        </div>
    </section>

    <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
@endsection