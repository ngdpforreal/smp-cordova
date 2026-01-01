@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div 
        x-data="{ 
            activeSlide: 0, 
            totalSlides: {{ $sliders->count() }},
            timer: null,
            start() {
                this.timer = setInterval(() => {
                    this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
                }, 5000); // Ganti gambar setiap 5000ms (5 detik)
            },
            stop() {
                clearInterval(this.timer);
            }
        }"
        x-init="start()"
        @mouseenter="stop()" 
        @mouseleave="start()"
        class="relative w-full h-[500px] md:h-[800px] overflow-hidden bg-gray-900"
    >
        @if($sliders->count() > 0)
            @foreach($sliders as $index => $slider)
                <div 
                    class="absolute inset-0 transition-all duration-1000 ease-in-out transform 
                    {{ $loop->first ? 'opacity-100 scale-100 z-20' : 'opacity-0 scale-105 z-10' }}" 
                    :class="{ 
                        'opacity-100 scale-100 z-20': activeSlide === {{ $index }}, 
                        'opacity-0 scale-105 z-10': activeSlide !== {{ $index }} 
                    }"
                >
                    <img 
    src="{{ asset('storage/' . $slider->image) }}" 
    alt="{{ $slider->getTranslation('title', app()->getLocale()) }}"
    class="absolute inset-0 w-full h-full object-cover object-center"
    {{-- Atribut Khusus untuk Slide Pertama --}}
    @if($loop->first) 
        fetchpriority="high" 
        loading="eager" 
    @else 
        loading="lazy" 
    @endif
>
                    
                    <div class="absolute inset-0 bg-gradient-to-r from-yayasan/90 via-yayasan/40 to-black/30"></div>
                
                    <div class="relative container mx-auto px-4 h-full flex flex-col justify-center text-white pt-20">
                        <div class="max-w-3xl space-y-4 md:space-y-6 transition-all duration-1000 delay-300"
                            :class="activeSlide === {{ $index }} ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
                            
                            <span class="inline-block py-1 px-3 border border-gold text-gold text-[10px] md:text-sm font-medium tracking-widest uppercase rounded-full mb-1 md:mb-2 bg-black/20 backdrop-blur-sm">
                                Yayasan Mabadi'ul Ihsan | Daar Al Ihsan
                            </span>
                            
                            <h1 class="text-3xl md:text-6xl font-serif font-bold leading-tight drop-shadow-lg">
                                {{ $slider->getTranslation('title', app()->getLocale()) ?? 'Mendidik Ilmu, Menanam Adab' }}
                            </h1>
                            
                            <p class="text-sm md:text-xl text-gray-200 font-light leading-relaxed max-w-2xl drop-shadow-md line-clamp-3 md:line-clamp-none">
                                {{ $slider->getTranslation('subtitle', app()->getLocale()) ?? 'Membentuk generasi unggul yang berwawasan global dengan karakter pesantren yang kuat.' }}
                            </p>
                            
                            <div class="flex flex-col sm:flex-row gap-3 md:gap-4 pt-2 md:pt-4 w-full sm:w-auto">
                                @if($slider->button_text)
                                    <a href="{{ $slider->button_link ?? '#' }}" 
                                    target="{{ $slider->open_new_tab ? '_blank' : '_self' }}"
                                    {{-- Tambahkan rel noopener jika target blank demi keamanan --}}
                                    rel="{{ $slider->open_new_tab ? 'noopener noreferrer' : '' }}"
                                    class="px-6 py-2.5 md:px-8 md:py-3 bg-gold text-yayasan-dark font-bold text-sm md:text-base rounded-full hover:bg-white hover:text-yayasan transition-all duration-300 shadow-lg text-center w-full sm:w-auto">
                                        {{ $slider->getTranslation('button_text', app()->getLocale()) }}
                                    </a>
                                @endif  
                                @if($slider->button2_text)
                                    <a href="{{ $slider->button2_link ?? '#' }}" 
                                    target="{{ $slider->button2_new_tab ? '_blank' : '_self' }}"
                                    rel="{{ $slider->button2_new_tab ? 'noopener noreferrer' : '' }}"
                                    class="px-6 py-2.5 md:px-8 md:py-3 border-2 border-white text-white font-medium text-sm md:text-base rounded-full hover:bg-white/20 transition-all duration-300 text-center w-full sm:w-auto">
                                        {{ $slider->getTranslation('button2_text', app()->getLocale()) }}
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-30 flex space-x-3">
                @foreach($sliders as $index => $slider)
                    <button 
                        @click="activeSlide = {{ $index }}" 
                        class="w-3 h-3 rounded-full transition-all duration-300 border border-white"
                        :class="activeSlide === {{ $index }} ? 'bg-gold w-8' : 'bg-transparent hover:bg-white/50'"
                    ></button>
                @endforeach
            </div>

        @else
            <div class="absolute inset-0 bg-yayasan flex items-center justify-center text-white">
                <h2 class="text-2xl">Data Slider Belum Diisi di Admin Panel</h2>
            </div>
        @endif
    </div>

    <section class="py-12 md:py-24 bg-white relative">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                
                <div class="order-2 md:order-1 relative overflow-hidden md:overflow-visible"> 
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-gold/20 rounded-full blur-[60px] -z-10 opacity-60"></div>

                    <div x-data="{ playing: false }" class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white ring-1 ring-gray-100 group aspect-video bg-black">
                        
                        @php
                            $rawVideoUrl = \App\Models\Setting::where('key', 'home_video')->value('value');
                            $videoId = null;
                            $videoEmbedUrl = null;

                            if ($rawVideoUrl) {
                                // Ekstrak Video ID untuk Thumbnail & Embed
                                if (str_contains($rawVideoUrl, 'youtube.com/watch?v=')) {
                                    $parts = explode('v=', $rawVideoUrl);
                                    $videoId = explode('&', $parts[1])[0];
                                } elseif (str_contains($rawVideoUrl, 'youtu.be/')) {
                                    $parts = explode('youtu.be/', $rawVideoUrl);
                                    $videoId = explode('?', $parts[1])[0];
                                }
                                
                                if($videoId) {
                                    $videoEmbedUrl = "https://www.youtube.com/embed/" . $videoId;
                                }
                            }
                        @endphp

                        @if($videoId)
                            <div x-show="!playing" 
                                 class="absolute inset-0 z-10 cursor-pointer group"
                                 @click="playing = true">
                                
                                <img src="https://img.youtube.com/vi/{{ $videoId }}/maxresdefault.jpg" 
                                     alt="Video Cover" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                
                                <div class="absolute inset-0 bg-transparent group-hover:bg-black/20 transition-colors duration-300"></div>

                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="relative w-20 h-20 flex items-center justify-center">
                                        <div class="absolute inset-0 bg-gold rounded-full opacity-75 animate-ping"></div>
                                        <div class="relative w-20 h-20 bg-white/90 backdrop-blur-md rounded-full flex items-center justify-center shadow-lg transition-transform duration-300 group-hover:scale-110 group-hover:bg-gold">
                                            <svg class="w-8 h-8 text-yayasan group-hover:text-white ml-1 transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="absolute bottom-4 left-4 px-3 py-1 bg-black/60 backdrop-blur-sm rounded-lg text-white text-xs font-bold tracking-wide">
                                    {{ __('Video Profil') }}
                                </div>
                            </div>

                            <template x-if="playing">
                                <iframe 
                                    src="{{ $videoEmbedUrl }}?autoplay=1&rel=0&modestbranding=1&showinfo=0" 
                                    title="Video Profil"
                                    class="w-full h-full absolute inset-0" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                                </iframe>
                            </template>

                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                <span class="text-sm">{{ __('Video Belum Tersedia') }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 flex items-center justify-center gap-2 text-sm text-gray-500 font-medium">
                        <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                        {{ __('Klik Play') }}
                    </div>
                </div>

                <div class="order-1 md:order-2">
                    <span class="text-gold font-bold tracking-widest uppercase text-sm">{{ __('Tentang Sekolah') }}</span>
                    
                    <h2 class="text-3xl md:text-5xl font-serif font-bold text-yayasan mt-3 mb-6 leading-tight">
                        {{ \App\Models\Setting::where('key', 'home_about_title')->value('value') ?? 'Integrasi Nilai Pesantren & Standar Internasional' }}
                    </h2>
                    
                    <p class="text-gray-600 text-lg leading-relaxed mb-8">
                        {{ \App\Models\Setting::where('key', 'home_about_desc')->value('value') ?? 'Kami hadir dengan konsep pendidikan holistik yang memadukan kurikulum nasional, wawasan global Cambridge, dan pembentukan karakter Qurani khas pesantren.' }}
                    </p>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-yayasan/10 flex items-center justify-center text-yayasan mt-1 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">
                                    {{ \App\Models\Setting::where('key', 'home_feat1_title')->value('value') ?? 'Kurikulum Cambridge & Nasional' }}
                                </h4>
                                <p class="text-sm text-gray-500">
                                    {{ \App\Models\Setting::where('key', 'home_feat1_desc')->value('value') ?? 'Mempersiapkan siswa bersaing di kancah global.' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-yayasan/10 flex items-center justify-center text-yayasan mt-1 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">
                                    {{ \App\Models\Setting::where('key', 'home_feat2_title')->value('value') ?? 'Program Tahfidz Intensif' }}
                                </h4>
                                <p class="text-sm text-gray-500">
                                    {{ \App\Models\Setting::where('key', 'home_feat2_desc')->value('value') ?? 'Target hafalan mutqin dengan sanad bersambung.' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('profile.history') }}" class="inline-flex items-center text-yayasan font-bold hover:text-gold transition gap-2 border-b-2 border-yayasan pb-1 hover:border-gold">
                        {{ __('Baca Sejarah') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
    {{-- === SECTION STATISTIK (SCROLL TRIGGERED & CLEAN) === --}}
    <section class="py-16 bg-white border-t border-gray-100">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12 divide-x divide-gray-100">
                
                {{-- ITEM 1: TOTAL SISWA --}}
                <div x-data="{ 
                        current: 0, 
                        target: 850,
                        animate() {
                            let i = setInterval(() => {
                                if (this.current < this.target) {
                                    this.current += Math.ceil(this.target / 50);
                                    if (this.current > this.target) this.current = this.target;
                                } else { clearInterval(i) }
                            }, 20);
                        }
                     }" 
                     x-init="
                        const observer = new IntersectionObserver((entries) => {
                            if (entries[0].isIntersecting) {
                                animate();
                                observer.disconnect(); // Stop memantau setelah animasi jalan
                            }
                        }, { threshold: 0.5 }); // Animasi jalan saat 50% elemen terlihat
                        observer.observe($el);
                     "
                     class="text-center group px-4">
                    
                    <div class="w-14 h-14 mx-auto bg-yayasan/5 rounded-2xl flex items-center justify-center text-yayasan mb-4 group-hover:bg-yayasan group-hover:text-white transition-all duration-300 transform group-hover:-translate-y-1">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    
                    <div class="text-4xl md:text-5xl font-serif font-bold text-yayasan mb-2 flex justify-center items-start">
                        <span x-text="current">0</span>
                        <span class="text-lg text-gold mt-1 ml-1">+</span>
                    </div>
                    
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-widest group-hover:text-gold transition-colors">
                        {{ __('Siswa Aktif') }}
                    </p>
                </div>

                {{-- ITEM 2: GURU & STAFF --}}
                <div x-data="{ 
                        current: 0, 
                        target: 65,
                        animate() {
                            let i = setInterval(() => {
                                if (this.current < this.target) {
                                    this.current += Math.ceil(this.target / 50);
                                    if (this.current > this.target) this.current = this.target;
                                } else { clearInterval(i) }
                            }, 40);
                        }
                     }" 
                     x-init="
                        const observer = new IntersectionObserver((entries) => {
                            if (entries[0].isIntersecting) {
                                animate();
                                observer.disconnect();
                            }
                        }, { threshold: 0.5 });
                        observer.observe($el);
                     "
                     class="text-center group px-4">
                     
                    <div class="w-14 h-14 mx-auto bg-yayasan/5 rounded-2xl flex items-center justify-center text-yayasan mb-4 group-hover:bg-yayasan group-hover:text-white transition-all duration-300 transform group-hover:-translate-y-1">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    
                    <div class="text-4xl md:text-5xl font-serif font-bold text-yayasan mb-2">
                        <span x-text="current">0</span>
                        <span class="text-lg text-gold mt-1 ml-1">+</span>
                    </div>
                    
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-widest group-hover:text-gold transition-colors">
                        {{ __('Guru & Staff') }}
                    </p>
                </div>

                {{-- ITEM 3: ALUMNI --}}
                <div x-data="{ 
                        current: 0, 
                        target: 1200,
                        animate() {
                            let i = setInterval(() => {
                                if (this.current < this.target) {
                                    this.current += Math.ceil(this.target / 50);
                                    if (this.current > this.target) this.current = this.target;
                                } else { clearInterval(i) }
                            }, 20);
                        }
                     }" 
                     x-init="
                        const observer = new IntersectionObserver((entries) => {
                            if (entries[0].isIntersecting) {
                                animate();
                                observer.disconnect();
                            }
                        }, { threshold: 0.5 });
                        observer.observe($el);
                     "
                     class="text-center group px-4">
                     
                    <div class="w-14 h-14 mx-auto bg-yayasan/5 rounded-2xl flex items-center justify-center text-yayasan mb-4 group-hover:bg-yayasan group-hover:text-white transition-all duration-300 transform group-hover:-translate-y-1">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    
                    <div class="text-4xl md:text-5xl font-serif font-bold text-yayasan mb-2 flex justify-center items-start">
                        <span x-text="current">0</span>
                        <span class="text-lg text-gold mt-1 ml-1">+</span>
                    </div>
                    
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-widest group-hover:text-gold transition-colors">
                        {{ __('Alumni') }}
                    </p>
                </div>

                {{-- ITEM 4: PENGHARGAAN --}}
                <div x-data="{ 
                        current: 0, 
                        target: 150,
                        animate() {
                            let i = setInterval(() => {
                                if (this.current < this.target) {
                                    this.current += Math.ceil(this.target / 50);
                                    if (this.current > this.target) this.current = this.target;
                                } else { clearInterval(i) }
                            }, 30);
                        }
                     }" 
                     x-init="
                        const observer = new IntersectionObserver((entries) => {
                            if (entries[0].isIntersecting) {
                                animate();
                                observer.disconnect();
                            }
                        }, { threshold: 0.5 });
                        observer.observe($el);
                     "
                     class="text-center group px-4 border-r-0">
                     
                    <div class="w-14 h-14 mx-auto bg-yayasan/5 rounded-2xl flex items-center justify-center text-yayasan mb-4 group-hover:bg-yayasan group-hover:text-white transition-all duration-300 transform group-hover:-translate-y-1">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    
                    <div class="text-4xl md:text-5xl font-serif font-bold text-yayasan mb-2 flex justify-center items-start">
                        <span x-text="current">0</span>
                        <span class="text-lg text-gold mt-1 ml-1">+</span>
                    </div>
                    
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-widest group-hover:text-gold transition-colors">
                        {{ __('Penghargaan') }}
                    </p>
                </div>

            </div>
        </div>
    </section>
    <section class="py-12 md:py-24 bg-gray-50 border-t border-gray-200">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-gold font-bold tracking-widest uppercase text-sm">{{ __('Keunggulan Kami') }}</span>
                <h2 class="text-3xl md:text-5xl font-serif font-bold text-yayasan mt-2">{{ __('Program Pendidikan') }}</h2>
                <div class="w-24 h-1 bg-gold mx-auto mt-6 rounded-full"></div>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto text-lg">
                    {{ __('Deskripsi Program') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($programs as $program)
                    <a href="{{ route('programs.index') }}" class="block group p-8 bg-white rounded-3xl transition-all duration-300 hover:-translate-y-2 shadow-sm hover:shadow-2xl border border-gray-100 hover:border-gold/30 relative overflow-hidden">
                        
                        <div class="w-16 h-16 bg-yayasan/5 rounded-2xl flex items-center justify-center text-yayasan mb-6 group-hover:bg-yayasan group-hover:text-white transition-all duration-300 shadow-sm group-hover:shadow-md relative z-10">
    
                            @switch($program->icon)
                                @case('globe')
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @break

                                @case('book-open')
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                    @break

                                @case('cpu')
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                                    @break
                                    
                                @case('star')
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                    @break

                                @case('user-group')
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    @break

                                @case('chat')
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                    @break

                                @default
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            @endswitch

                        </div>
                        
                        <h3 class="text-xl font-serif font-bold text-gray-900 mb-3 group-hover:text-yayasan transition-colors relative z-10">{{ $program->getTranslation('title', app()->getLocale()) }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4 relative z-10">
                            {{ $program->getTranslation('description', app()->getLocale()) }}
                        </p>
                        
                        <span class="inline-flex items-center text-sm font-bold text-gold group-hover:text-yayasan transition-colors mt-2 relative z-10">
                            {{ __('Selengkapnya') }} 
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-12 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-end mb-12">
                <div class="max-w-2xl">
                    <span class="text-gold font-bold tracking-widest uppercase text-sm flex items-center gap-2">
                        <span class="w-8 h-px bg-gold"></span> {{ __('Informasi Terkini') }}
                    </span>
                    <h2 class="text-3xl md:text-5xl font-serif font-bold text-yayasan mt-3 leading-tight">
                        {{ __('Berita & Kabar Sekolah') }}
                    </h2>
                    <p class="text-gray-500 mt-4 text-lg leading-relaxed">
                        {{ __('Deskripsi Berita') }}
                    </p>
                </div>
                <a href="{{ route('posts.index') }}" class="hidden md:inline-flex items-center font-bold text-yayasan hover:text-gold transition">
                    {{ __('Lihat Semua Berita') }} <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($latest_posts as $post)
                    <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group flex flex-col h-full border border-gray-100 hover:border-gold/30">
                        <div class="h-48 overflow-hidden relative bg-gray-200">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->getTranslation('title', app()->getLocale()) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-yayasan/5 text-yayasan">
                                    <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-md text-xs font-bold text-yayasan shadow-sm">
                                {{ $post->created_at->format('d M Y') }}
                            </div>
                        </div>
                        
                        <div class="p-6 flex-1 flex flex-col">
                            <span class="text-xs font-bold text-gold uppercase tracking-wider mb-2">{{ $post->category }}</span>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 leading-tight group-hover:text-yayasan transition-colors line-clamp-2">
                                <a href="{{ route('posts.show', $post->slug) }}">{{ $post->getTranslation('title', app()->getLocale()) }}</a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-1">
                                @php
                                    $content = $post->getTranslation('content', app()->getLocale());
                                    // Convert array to string if needed
                                    if (is_array($content)) {
                                        $content = json_encode($content); // atau berikan nilai default
                                    }
                                @endphp
                                {{ Str::limit(\App\Helpers\TiptapParser::toText($post->getTranslation('content', app()->getLocale())), 100) }}
                            </p>
                            <div class="pt-4 border-t border-gray-100 mt-auto">
                                <a href="{{ route('posts.show', $post->slug) }}" class="text-sm font-semibold text-yayasan hover:text-gold transition flex items-center gap-1">
                                    {{ __('Baca Selengkapnya') }}
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            
            <div class="mt-8 text-center md:hidden">
                <a href="{{ route('posts.index') }}" class="inline-block px-6 py-3 border border-yayasan text-yayasan font-bold rounded-full hover:bg-yayasan hover:text-white transition">
                    {{ __('Lihat Semua Berita') }}
                </a>
            </div>
        </div>
    </section>
    <section class="py-12 md:py-24 bg-gray-50 border-t border-gray-200">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div class="max-w-2xl">
                    <span class="text-gold font-bold tracking-widest uppercase text-sm flex items-center gap-2">
                        <span class="w-8 h-px bg-gold"></span> {{ __('Lingkungan Belajar') }}
                    </span>
                    <h2 class="text-3xl md:text-5xl font-serif font-bold text-yayasan mt-3 leading-tight">
                        {{ __('Fasilitas Lengkap Modern') }}
                    </h2>
                    <p class="text-gray-500 mt-4 text-lg leading-relaxed">
                        {{ __('Deskripsi Fasilitas') }}
                    </p>
                </div>
                <a href="{{ route('profile.facilities') }}" class="hidden md:inline-flex items-center font-bold text-yayasan hover:text-gold transition">
                    {{ __('Lihat Semua Fasilitas') }} 
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            @if($facilities->count() >= 4)
                <div class="grid grid-cols-1 md:grid-cols-4 grid-rows-2 gap-4 h-auto md:h-[500px]">
                    <div class="md:col-span-2 md:row-span-2 relative group overflow-hidden rounded-2xl bg-white shadow-md">
                        <img src="{{ asset('storage/' . $facilities[0]->file_path) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="{{ $facilities[0]->getTranslation('title', app()->getLocale()) }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex flex-col justify-end p-6">
                            <h3 class="text-white font-bold text-xl">{{ $facilities[0]->getTranslation('title', app()->getLocale()) }}</h3>
                            <p class="text-gray-300 text-sm line-clamp-1">{{ $facilities[0]->getTranslation('description', app()->getLocale()) }}</p>
                        </div>
                    </div>

                    <div class="md:col-span-1 md:row-span-1 relative group overflow-hidden rounded-2xl bg-white shadow-md">
                        <img src="{{ asset('storage/' . $facilities[1]->file_path) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="{{ $facilities[1]->title }}">
                        <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition flex items-end p-4">
                            <span class="text-white font-bold text-sm">{{ $facilities[1]->getTranslation('title', app()->getLocale()) }}</span>
                        </div>
                    </div>

                    <div class="md:col-span-1 md:row-span-1 relative group overflow-hidden rounded-2xl bg-white shadow-md">
                        <img src="{{ asset('storage/' . $facilities[2]->file_path) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="{{ $facilities[2]->title }}">
                        <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition flex items-end p-4">
                            <span class="text-white font-bold text-sm">{{ $facilities[2]->getTranslation('title', app()->getLocale()) }}</span>
                        </div>
                    </div>

                    <div class="md:col-span-2 md:row-span-1 relative group overflow-hidden rounded-2xl bg-white shadow-md">
                        <img src="{{ asset('storage/' . $facilities[3]->file_path) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="{{ $facilities[3]->title }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex flex-col justify-end p-6">
                            <h3 class="text-white font-bold text-xl">{{ $facilities[3]->getTranslation('title', app()->getLocale()) }}</h3>
                        </div>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-4 grid-rows-2 gap-4 h-auto md:h-[500px]">
                    <div class="md:col-span-2 md:row-span-2 relative group overflow-hidden rounded-2xl bg-gray-200 flex items-center justify-center text-gray-400">
                        <span class="text-center">Upload minimal 4 foto fasilitas</span>
                    </div>
                </div>
            @endif
            <div class="mt-8 text-center md:hidden">
                <a href="{{ route('profile.facilities') }}" class="inline-block px-6 py-3 border border-yayasan text-yayasan font-bold rounded-full hover:bg-yayasan hover:text-white transition">
                    {{ __('Lihat Semua Fasilitas') }}
                </a>
            </div>
        </div>
    </section>
    <section class="py-12 md:py-24 bg-white border-t border-gray-200 overflow-hidden group/section">
        <div class="container mx-auto px-4 relative">
            
            <div class="text-center mb-16">
                <span class="text-gold font-bold tracking-widest uppercase text-sm">{{ __('Pengembangan Bakat') }}</span>
                <h2 class="text-3xl md:text-5xl font-serif font-bold text-yayasan mt-3">{{ __('Ekstrakurikuler') }}</h2>
                <div class="w-24 h-1 bg-gold mx-auto mt-6 rounded-full"></div>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto text-lg font-light">
                    {{ __('Deskripsi Ekskul') }}
                </p>
            </div>

            <div x-data="{
                    scrollLeft() {
                        let container = this.$refs.scrollContainer;
                        // Jika sudah mentok kiri (awal), lompat ke paling kanan (akhir)
                        if (container.scrollLeft <= 0) {
                            container.scrollTo({ left: container.scrollWidth, behavior: 'smooth' });
                        } else {
                            // Geser ke kiri normal
                            container.scrollBy({ left: -320, behavior: 'smooth' });
                        }
                    },
                    scrollRight() {
                        let container = this.$refs.scrollContainer;
                        // Cek apakah sudah mentok kanan (toleransi 10px)
                        // Rumus: Posisi Scroll + Lebar Layar >= Total Panjang Konten
                        if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
                            // Kembali ke awal (Looping)
                            container.scrollTo({ left: 0, behavior: 'smooth' });
                        } else {
                            // Geser ke kanan normal
                            container.scrollBy({ left: 320, behavior: 'smooth' });
                        }
                    }
                }" 
                class="relative px-4">

                <button @click="scrollLeft()" 
                        class="absolute left-0 top-1/2 -translate-y-1/2 z-20 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center text-yayasan border border-gray-100 hover:bg-gold hover:text-white hover:border-gold transition-all duration-300 opacity-0 group-hover/section:opacity-100 -ml-2 md:-ml-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>

                <div x-ref="scrollContainer" 
                     class="flex gap-8 overflow-x-auto snap-x snap-mandatory pb-12 hide-scrollbar scroll-smooth">
                    
                    @foreach($extracurriculars as $ekskul)
                        <div class="snap-center flex-none w-[280px] md:w-[320px] group cursor-pointer">
                            
                            <div class="relative aspect-[4/3] rounded-2xl overflow-hidden bg-gray-100 shadow-sm transition-all duration-500 group-hover:shadow-xl group-hover:-translate-y-2 border border-gray-100">
                                @if($ekskul->image)
                                    <img src="{{ asset('storage/' . $ekskul->image) }}" 
                                         alt="{{ $ekskul->getTranslation('name', app()->getLocale()) }}" 
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-6 text-center group-hover:translate-x-1 transition-transform duration-300">
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-yayasan transition-colors font-serif">
                                    {{ $ekskul->getTranslation('name', app()->getLocale()) }}
                                </h3>
                                <div class="w-8 h-1 bg-gold rounded-full mx-auto mt-3 transition-all duration-300 group-hover:w-16"></div>
                            </div>

                        </div>
                    @endforeach

                </div>

                <button @click="scrollRight()" 
                        class="absolute right-0 top-1/2 -translate-y-1/2 z-20 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center text-yayasan border border-gray-100 hover:bg-gold hover:text-white hover:border-gold transition-all duration-300 opacity-0 group-hover/section:opacity-100 -mr-2 md:-mr-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>

            </div>
        </div>
    </section>

    <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <section class="py-12 md:py-24 bg-gray-50 border-t border-gray-200">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div class="max-w-2xl">
                    <span class="text-gold font-bold tracking-widest uppercase text-sm flex items-center gap-2">
                        <span class="w-8 h-px bg-gold"></span> {{ __('Prestasi Siswa') }}
                    </span>
                    <h2 class="text-3xl md:text-5xl font-serif font-bold text-yayasan mt-3 leading-tight">
                        {{ __('Tradisi Juara') }}
                    </h2>
                    <p class="text-gray-500 mt-4 text-lg leading-relaxed">
                        {{ __('Deskripsi Prestasi') }}
                    </p>
                </div>

                <div class="flex gap-4">
                   <div class="px-6 py-4 bg-white rounded-xl shadow-sm text-center border border-gray-100 border-b-4 border-b-gold">
                       <span class="block text-3xl font-bold text-yayasan">50+</span>
                       <span class="text-xs text-gray-500 uppercase tracking-wide font-bold">{{ __('Piala Tahun Ini') }}</span>
                   </div>
                   <div class="px-6 py-4 bg-white rounded-xl shadow-sm text-center border border-gray-100 border-b-4 border-b-gold">
                       <span class="block text-3xl font-bold text-yayasan">15+</span>
                       <span class="text-xs text-gray-500 uppercase tracking-wide font-bold">{{ __('Juara Nasional') }}</span>
                   </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($achievements as $achievement)
                <div class="group relative h-[400px] rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer bg-white border border-gray-100 hover:border-gold/30">
                    
                    @if($achievement->image)
                        <img src="{{ asset('storage/' . $achievement->image) }}" 
                             alt="{{ $achievement->getTranslation('title', app()->getLocale()) }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    @else
                        <div class="w-full h-full bg-gray-50 flex items-center justify-center relative">
                            <svg class="w-20 h-20 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"></path></svg>
                        </div>
                    @endif

                    <div class="absolute top-4 left-4 z-10">
                        <span class="px-3 py-1 bg-white/95 backdrop-blur-md text-yayasan font-bold text-xs uppercase tracking-wider rounded-lg shadow-md border border-gray-100 flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-gold animate-pulse"></span>
                            {{ $achievement->rank }}
                        </span>
                    </div>

                    <div class="absolute bottom-4 left-4 right-4 bg-white/95 backdrop-blur-md p-5 rounded-xl shadow-lg border border-gray-200 transform transition-all duration-300 group-hover:-translate-y-1">
                        <div class="absolute top-0 left-0 w-0 h-1 bg-gold transition-all duration-500 group-hover:w-full rounded-t-xl"></div>
                        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">
                            Tingkat {{ $achievement->level }}
                        </p>
                        <h3 class="text-lg font-bold text-gray-900 leading-snug mb-3 group-hover:text-yayasan transition-colors line-clamp-2">
                            {{ $achievement->getTranslation('title', app()->getLocale()) }}
                        </h3>
                        <p class="text-xs text-gray-500 mb-4 line-clamp-2 leading-relaxed">
                            {{ $achievement->getTranslation('description', app()->getLocale()) }}
                        </p>
                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <span class="text-sm text-gray-600 font-medium truncate max-w-[110px]">
                                    {{ $achievement->recipient }}
                                </span>
                            </div>
                            <span class="text-xs text-gold font-bold bg-gold/10 px-2 py-1 rounded">
                                {{ $achievement->year }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('galleries.index', ['tab' => 'prestasi']) }}" class="inline-flex items-center gap-2 px-8 py-3 bg-white text-yayasan font-bold rounded-full border border-gray-200 hover:bg-gold hover:text-yayasan-dark hover:border-gold transition-all duration-300 shadow-sm hover:shadow-lg">
                    {{ __('Lihat Galeri Prestasi') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-24 relative overflow-hidden bg-gradient-to-b from-yayasan to-[#5d0000] group/testi">
        
        <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#d4af37 1px, transparent 1px); background-size: 30px 30px;"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-20">
                <span class="text-gold font-bold tracking-widest uppercase text-sm">{{ __('Kata Mereka') }}</span>
                <h2 class="text-3xl md:text-5xl font-serif font-bold text-white mt-2">{{ __('Suara Keluarga') }}</h2>
                <div class="w-24 h-1 bg-gold mx-auto mt-6 rounded-full"></div>
            </div>

            <div x-data="{
                scrollLeft() {
                    // Langsung akses $refs tanpa variabel perantara untuk menghindari error initialization
                    const step = this.$refs.testiContainer.firstElementChild.offsetWidth + 32;
                    
                    if (this.$refs.testiContainer.scrollLeft <= 10) {
                        this.$refs.testiContainer.scrollTo({ 
                            left: this.$refs.testiContainer.scrollWidth, 
                            behavior: 'smooth' 
                        });
                    } else {
                        this.$refs.testiContainer.scrollBy({ left: -step, behavior: 'smooth' });
                    }
                },
                scrollRight() {
                    const step = this.$refs.testiContainer.firstElementChild.offsetWidth + 32;
                    
                    // Logika deteksi akhir yang lebih kuat
                    const isAtEnd = Math.ceil(this.$refs.testiContainer.scrollLeft + this.$refs.testiContainer.offsetWidth) >= this.$refs.testiContainer.scrollWidth - 10;
                    
                    if (isAtEnd) {
                        this.$refs.testiContainer.scrollTo({ left: 0, behavior: 'smooth' });
                    } else {
                        this.$refs.testiContainer.scrollBy({ left: step, behavior: 'smooth' });
                    }
                }
            }" 
                class="relative">

                <button type="button" 
                        @click="scrollLeft()" 
                        class="absolute left-0 top-[55%] -translate-y-1/2 z-20 w-12 h-12 bg-white rounded-full border border-gray-100 text-yayasan flex items-center justify-center hover:bg-gold hover:text-white hover:border-gold transition-all duration-300 opacity-0 group-hover/testi:opacity-100 -ml-4 md:-ml-8 shadow-lg cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>

                <div x-ref="testiContainer" style="scroll-behavior: auto !important;"
                     class="flex gap-8 overflow-x-auto snap-x snap-proximity pb-12 hide-scrollbar">
                    
                    @foreach($testimonials as $testi)
                        <div class="testi-card snap-center shrink-0 w-full md:w-[calc(33.333%-1.4rem)] pt-12"> 
                            
                            <div class="bg-white rounded-2xl p-8 pt-16 shadow-2xl h-full flex flex-col items-center text-center relative border-b-4 border-gold transition-transform duration-300 hover:-translate-y-2">
                                
                                <div class="absolute -top-10 left-1/2 transform -translate-x-1/2">
                                    <div class="w-24 h-24 rounded-full border-4 border-white shadow-lg overflow-hidden bg-gray-200">
                                        @if($testi->photo)
                                            <img src="{{ asset('storage/' . $testi->photo) }}" alt="{{ $testi->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="absolute bottom-0 right-0 w-8 h-8 bg-gold rounded-full flex items-center justify-center text-yayasan shadow-md border-2 border-white">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 8.44772 14.017 9V11C14.017 11.5523 13.5693 12 13.017 12H12.017V5H22.017V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM5.0166 21L5.0166 18C5.0166 16.8954 5.91203 16 7.0166 16H10.0166C10.5689 16 11.0166 15.5523 11.0166 15V9C11.0166 8.44772 10.5689 8 10.0166 8H6.0166C5.46432 8 5.0166 8.44772 5.0166 9V11C5.0166 11.5523 4.56889 12 4.0166 12H3.0166V5H13.0166V15C13.0166 18.3137 10.3303 21 7.0166 21H5.0166Z"></path></svg>
                                    </div>
                                </div>

                                <div class="flex text-yellow-400 gap-1 mb-4 mt-2">
                                    @for($i=0; $i < ($testi->rating ?? 5); $i++)
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    @endfor
                                </div>

                                <p class="text-gray-600 italic leading-relaxed mb-6 font-medium">
                                    "{{ $testi->getTranslation('content', app()->getLocale()) }}"
                                </p>

                                <div class="mt-auto">
                                    <h4 class="font-bold text-yayasan text-lg">{{ $testi->name }}</h4>
                                    <p class="text-xs text-gold uppercase tracking-widest font-bold mt-1">{{ $testi->getTranslation('role', app()->getLocale()) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" 
                        @click="scrollRight()" 
                        class="absolute right-0 top-[55%] -translate-y-1/2 z-20 w-12 h-12 bg-white rounded-full border border-gray-100 text-yayasan flex items-center justify-center hover:bg-gold hover:text-white hover:border-gold transition-all duration-300 opacity-0 group-hover/testi:opacity-100 -mr-4 md:-ml-8 shadow-lg cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>

            </div>
            <div class="mt-12 text-center relative z-20">
                <a href="{{ route('profile.testimonials') }}" 
                   class="inline-flex items-center gap-2 px-8 py-3 border border-gold text-gold font-bold rounded-full hover:bg-gold hover:text-yayasan-dark transition-all duration-300 group">
                    <span>{{ __('Lihat Semua Testimoni') }}</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection