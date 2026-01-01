@extends('layouts.app')

@section('title', __('Galeri Sekolah'))

@section('content')
    <x-header-page 
        :title="__('Dokumentasi Sekolah')"
        :subtitle="__('Subtitle Galeri')"
        :breadcrumb="__('Galeri')"
    />

    <section class="py-20 bg-neutral-50 min-h-screen" 
             x-data="{ 
                 activeTab: '{{ request('tab', 'all') }}', 
                 modalOpen: false, 
                 activeImage: '', 
                 activeTitle: '',
                 activeDescription: '',
                 activeCategory: ''
             }">
        <div class="container mx-auto px-4">
            
            {{-- FILTER BUTTONS --}}
            <div class="flex flex-wrap justify-center items-center gap-2 mb-16">
                <button @click="activeTab = 'all'" 
                    :class="activeTab === 'all' ? 'bg-yayasan text-white shadow-lg' : 'bg-white text-gray-500 hover:bg-gray-100 hover:text-yayasan'"
                    class="px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 border border-transparent">
                    {{ __('Semua Foto') }}
                </button>
                
                {{-- Tombol Filter Manual --}}
                <button @click="activeTab = 'kegiatan'" 
                    :class="activeTab === 'kegiatan' ? 'bg-yayasan text-white shadow-lg' : 'bg-white text-gray-500 hover:bg-gray-100 hover:text-yayasan'"
                    class="px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 border border-transparent">
                    {{ __('Kegiatan') }}
                </button>
                <button @click="activeTab = 'fasilitas'" 
                    :class="activeTab === 'fasilitas' ? 'bg-yayasan text-white shadow-lg' : 'bg-white text-gray-500 hover:bg-gray-100 hover:text-yayasan'"
                    class="px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 border border-transparent">
                    {{ __('Fasilitas') }}
                </button>
                <button @click="activeTab = 'prestasi'" 
                    :class="activeTab === 'prestasi' ? 'bg-yayasan text-white shadow-lg' : 'bg-white text-gray-500 hover:bg-gray-100 hover:text-yayasan'"
                    class="px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 border border-transparent">
                    {{ __('Penghargaan') }}
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @forelse($galleries as $gallery)
                    {{-- Filter Logic: Gunakan raw category dari DB untuk logic tab --}}
                    <div x-show="activeTab === 'all' || activeTab === '{{ strtolower($gallery->category) }}'"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 translate-y-10"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="group relative rounded-2xl overflow-hidden cursor-pointer shadow-md hover:shadow-2xl transition-all duration-500 bg-gray-200 aspect-[4/3]"
                         @click="
                            modalOpen = true; 
                            activeImage = '{{ asset('storage/' . $gallery->file_path) }}'; 
                            // PERBAIKAN: Gunakan property langsung karena sudah diterjemahkan di Controller
                            activeTitle = '{{ addslashes($gallery->title) }}'; 
                            activeDescription = '{{ addslashes(\Illuminate\Support\Str::limit($gallery->description, 200)) }}';
                            // Terjemahkan Kategori untuk Label di Modal
                            activeCategory = '{{ __('Kategori ' . strtolower($gallery->category)) }}'
                         ">
                        
                        <img src="{{ asset('storage/' . $gallery->file_path) }}" 
                             alt="{{ $gallery->title }}" 
                             loading="lazy"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            
                            {{-- Label Kategori di Card --}}
                            <span class="inline-block px-3 py-1 bg-gold/90 backdrop-blur-sm text-yayasan-dark text-[10px] font-bold uppercase tracking-widest rounded mb-2 w-fit transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-100">
                                {{ __('Kategori ' . strtolower($gallery->category)) }}
                            </span>
                            
                            {{-- Judul (Sudah diterjemahkan dari Controller) --}}
                            <h3 class="text-white font-serif font-bold text-lg leading-snug transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-150">
                                {{ $gallery->title }}
                            </h3>
                            <p class="text-gray-200 text-xs mt-2 line-clamp-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-200">
                                {{ $gallery->description }}
                            </p>

                            <div class="mt-3 flex items-center gap-2 text-white/80 text-xs transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                <span>{{ __('Perbesar Gambar') }}</span>
                            </div>
                        </div>

                        <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-md p-2 rounded-full opacity-100 group-hover:opacity-0 transition-opacity duration-300">
                            <svg class="w-5 h-5 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-20 text-center">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <p class="text-gray-500 font-medium">{{ __('Belum Ada Dokumentasi') }}</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-16">
                {{ $galleries->links() }}
            </div>

        </div>

        {{-- MODAL POPUP --}}
        <div x-show="modalOpen" 
             style="display: none;"
             class="fixed inset-0 z-[100] flex items-center justify-center bg-black/95 backdrop-blur-sm p-4"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <button @click="modalOpen = false" class="absolute top-6 right-6 z-50 text-white/50 hover:text-white transition focus:outline-none group">
                <span class="text-sm font-bold mr-2 opacity-0 group-hover:opacity-100 transition-opacity">{{ __('Tutup') }}</span>
                <svg class="w-10 h-10 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <div class="max-w-6xl w-full max-h-screen relative flex flex-col items-center justify-center" @click.away="modalOpen = false">
                <img :src="activeImage" class="w-auto h-auto max-h-[80vh] object-contain rounded-lg shadow-2xl">
                
                <div class="mt-6 text-center max-w-2xl mx-auto">
                    {{-- Kategori di Modal --}}
                    <span class="inline-block px-3 py-1 bg-gold text-yayasan-dark text-xs font-bold uppercase tracking-widest rounded mb-2" x-text="activeCategory"></span>
                    <h3 class="text-white text-xl md:text-2xl font-serif font-bold tracking-wide" x-text="activeTitle"></h3>
                    <p class="text-gray-300 text-sm md:text-base leading-relaxed" x-text="activeDescription"></p>
                </div>
            </div>
        </div>

    </section>
@endsection