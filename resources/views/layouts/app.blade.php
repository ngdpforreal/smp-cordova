<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SMP Plus Cordova') - SMP Plus Cordova</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;500;600;700&family=Merriweather:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-neutral-900 bg-neutral-50 flex flex-col min-h-screen overflow-x-hidden">

    <header x-data="{ mobileMenuOpen: false, profileOpen: false }" 
        class="fixed w-full z-50 transition-all duration-300" id="navbar">
        <div class="bg-yayasan text-white py-2 text-sm hidden md:block border-b border-yayasan-dark">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <div class="flex space-x-6">
                    <span class="flex items-center gap-2 opacity-90 hover:opacity-100 transition">
                        <svg class="w-4 h-4 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Karangdoro, Tegalsari, Banyuwangi
                    </span>
                    <span class="flex items-center gap-2 opacity-90 hover:opacity-100 transition">
                        <svg class="w-4 h-4 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        0812-3456-7890
                    </span>
                </div>
                <div class="flex space-x-4">
                    <a href="https://smp.ponpesmiha.online" target="_blank" rel="noopener noreferrer" class="hover:text-gold transition font-medium">Siakad</a>
                    <span class="text-white/30">|</span>
                    
                    <a href="#" target="_blank" rel="noopener noreferrer" class="hover:text-gold transition font-medium">E-Perpus</a>
                    <span class="text-white/30">|</span>
                    
                    <a href="https://silabor.my.id" target="_blank" rel="noopener noreferrer" class="hover:text-gold transition font-medium">Silabor</a>
                    <span class="text-white/30">|</span>
                    
                    <a href="#" target="_blank" rel="noopener noreferrer" class="hover:text-gold transition font-medium">E-Journal Guru</a>
                    <span class="text-white/30">|</span>
                    
                    <a href="https://www.quipper.com" target="_blank" rel="noopener noreferrer" class="hover:text-gold transition font-medium">E-Learning</a>
                    <span class="text-white/30 ml-4 mr-2">|</span>

                    {{-- LANGUAGE SWITCHER (DROPDOWN) --}}
                    <div x-data="{ open: false }" class="relative inline-block text-left">
                        
                        {{-- Tombol Pemicu --}}
                        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-1 hover:text-gold transition font-bold uppercase text-xs focus:outline-none">
                            @if(app()->getLocale() == 'id')
                                <img src="https://flagcdn.com/w20/id.png" width="20" alt="Indonesia">
                                <span>IND</span>
                            @else
                                <img src="https://flagcdn.com/w20/gb.png" width="20" alt="English">
                                <span>ENG</span>
                            @endif
                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        {{-- Isi Dropdown --}}
                        <div x-show="open" 
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            style="display: none;"
                            class="absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50 overflow-hidden">
                            
                            <div class="py-1">
                                <a href="{{ route('lang.switch', 'id') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-yayasan {{ app()->getLocale() == 'id' ? 'bg-gray-50 font-bold' : '' }}">
                                    <img src="https://flagcdn.com/w20/id.png" width="20" class="mr-3 shadow-sm" alt="ID">
                                    Indonesia
                                </a>
                                <a href="{{ route('lang.switch', 'en') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-yayasan {{ app()->getLocale() == 'en' ? 'bg-gray-50 font-bold' : '' }}">
                                    <img src="https://flagcdn.com/w20/gb.png" width="20" class="mr-3 shadow-sm" alt="EN">
                                    English
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white/95 backdrop-blur-md shadow-sm border-b border-gray-100">
            <div class="container mx-auto px-4 py-3 flex justify-between items-center">
                <div class="flex items-center gap-2 md:gap-4">
                    <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/smpplus.png') }}" 
                        alt="SMP Plus Cordova" 
                        class="h-12 md:h-14 w-auto transition-transform hover:scale-105">
                    </a>
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('images/ciis.png') }}" 
                            alt="SMP Plus Cordova" 
                            class="h-8 md:h-8 w-auto transition-transform hover:scale-105">
                    </a>
                </div>

                <nav class="hidden md:flex space-x-8 font-semibold text-sm items-center">
    
                    <a href="{{ url('/') }}" 
                    class="transition py-2 border-b-2 {{ request()->is('/') ? 'text-yayasan border-yayasan' : 'text-gray-600 border-transparent hover:text-yayasan hover:border-yayasan' }}">
                    {{ __('Beranda') }}  </a>
                    
                    <div class="group relative cursor-pointer py-2">
                        <span class="transition flex items-center gap-1 {{ request()->routeIs('profile.*') ? 'text-yayasan' : 'text-gray-600 hover:text-yayasan' }}">
                            {{ __('Profil') }} <svg class="w-3 h-3 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                        
                        <div class="absolute top-full left-0 mt-0 pt-2 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2">
                            <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-100">
                                <a href="{{ route('profile.history') }}" class="block px-5 py-3 transition border-b border-gray-50 {{ request()->routeIs('profile.history') ? 'bg-yayasan/5 text-yayasan font-bold' : 'hover:bg-gray-50 hover:text-yayasan text-gray-600' }}">
                                    {{ __('Sejarah & Visi Misi') }}
                                </a>
                                <a href="{{ route('profile.structure') }}" class="block px-5 py-3 transition border-b border-gray-50 {{ request()->routeIs('profile.structure') ? 'bg-yayasan/5 text-yayasan font-bold' : 'hover:bg-gray-50 hover:text-yayasan text-gray-600' }}">
                                    {{ __('Struktur Organisasi') }}
                                </a>
                                <a href="{{ route('profile.facilities') }}" class="block px-5 py-3 transition {{ request()->routeIs('profile.facilities') ? 'bg-yayasan/5 text-yayasan font-bold' : 'hover:bg-gray-50 hover:text-yayasan text-gray-600' }}">
                                    {{ __('Fasilitas') }}
                                </a>
                                <a href="{{ route('profile.testimonials') }}" class="block px-5 py-3 transition border-t border-gray-50 {{ request()->routeIs('profile.testimonials') ? 'bg-yayasan/5 text-yayasan font-bold' : 'hover:bg-gray-50 hover:text-yayasan text-gray-600' }}">
                                    {{ __('Testimoni') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('programs.index') }}" 
                    class="transition py-2 border-b-2 {{ request()->routeIs('programs.*') ? 'text-yayasan border-yayasan' : 'text-gray-600 border-transparent hover:text-yayasan hover:border-yayasan' }}">
                    {{ __('Program') }}
                    </a>

                    <a href="{{ route('extracurriculars.index') }}" 
                    class="transition py-2 border-b-2 {{ request()->routeIs('extracurriculars.*') ? 'text-yayasan border-yayasan' : 'text-gray-600 border-transparent hover:text-yayasan hover:border-yayasan' }}">
                    {{ __('Ekstrakurikuler') }}
                    </a>

                    <a href="{{ route('posts.index') }}" 
                    class="transition py-2 border-b-2 {{ request()->routeIs('posts.*') ? 'text-yayasan border-yayasan' : 'text-gray-600 border-transparent hover:text-yayasan hover:border-yayasan' }}">
                    {{ __('Berita') }}
                    </a>

                    <a href="{{ route('academic.index') }}" 
                    class="transition py-2 border-b-2 {{ request()->routeIs('academic.*') ? 'text-yayasan border-yayasan' : 'text-gray-600 border-transparent hover:text-yayasan hover:border-yayasan' }}">
                    {{ __('Kalender Akademik') }}
                    </a>

                    <a href="{{ route('galleries.index') }}" 
                    class="transition py-2 border-b-2 {{ request()->routeIs('galleries.*') ? 'text-yayasan border-yayasan' : 'text-gray-600 border-transparent hover:text-yayasan hover:border-yayasan' }}">
                    {{ __('Galeri') }}
                    </a>

                    <a href="{{ route('contact') }}" 
                    class="transition py-2 border-b-2 {{ request()->routeIs('contact') ? 'text-yayasan border-yayasan' : 'text-gray-600 border-transparent hover:text-yayasan hover:border-yayasan' }}">
                    {{ __('Hubungi Kami') }}
                    </a>
                    
                </nav>

                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-700 p-2 rounded-md hover:bg-gray-100 focus:outline-none transition">
                    <svg x-show="!mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    <svg x-show="mobileMenuOpen" style="display: none;" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
        <div x-show="mobileMenuOpen" 
            style="display: none;"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-5"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-5"
            class="md:hidden absolute top-full left-0 w-full bg-white border-t border-gray-100 shadow-xl max-h-[85vh] overflow-y-auto">
            
            <div class="p-4 space-y-2 pb-8">
                <a href="{{ url('/') }}" class="block px-4 py-3 rounded-lg font-bold {{ request()->is('/') ? 'bg-yayasan text-white' : 'text-gray-700 hover:bg-gray-50' }}">
                    {{ __('Beranda') }}
                </a>
                
                <div class="space-y-1">
                    <button @click="profileOpen = !profileOpen" class="w-full flex items-center justify-between px-4 py-3 rounded-lg font-bold text-gray-700 hover:bg-gray-50">
                        <span>{{ __('Profil Sekolah') }}</span>
                        <svg class="w-4 h-4 transition-transform duration-300" :class="profileOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="profileOpen" class="pl-4 space-y-1 border-l-2 border-gray-100 ml-4">
                        <a href="{{ route('profile.history') }}" class="block px-4 py-2 text-sm text-gray-600 hover:text-yayasan">{{ __('Sejarah & Visi Misi') }}</a>
                        <a href="{{ route('profile.structure') }}" class="block px-4 py-2 text-sm text-gray-600 hover:text-yayasan">{{ __('Struktur Organisasi') }}</a>
                        <a href="{{ route('profile.facilities') }}" class="block px-4 py-2 text-sm text-gray-600 hover:text-yayasan">{{ __('Fasilitas') }}</a>
                        <a href="{{ route('profile.testimonials') }}" class="block px-4 py-2 text-sm text-gray-600 hover:text-yayasan">{{ __('Testimoni') }}</a>
                    </div>
                </div>

                <a href="{{ route('programs.index') }}" class="block px-4 py-3 rounded-lg font-bold {{ request()->routeIs('programs.*') ? 'bg-yayasan text-white' : 'text-gray-700 hover:bg-gray-50' }}">{{ __('Program') }}</a>
                <a href="{{ route('extracurriculars.index') }}" class="block px-4 py-3 rounded-lg font-bold {{ request()->routeIs('extracurriculars.*') ? 'bg-yayasan text-white' : 'text-gray-700 hover:bg-gray-50' }}">{{ __('Ekstrakurikuler') }}</a>
                <a href="{{ route('academic.index') }}" class="block px-4 py-3 rounded-lg font-bold {{ request()->routeIs('academic.*') ? 'bg-yayasan text-white' : 'text-gray-700 hover:bg-gray-50' }}">{{ __('Kalender Akademik') }}</a>
                <a href="{{ route('posts.index') }}" class="block px-4 py-3 rounded-lg font-bold {{ request()->routeIs('posts.*') ? 'bg-yayasan text-white' : 'text-gray-700 hover:bg-gray-50' }}">{{ __('Berita') }}</a>
                <a href="{{ route('galleries.index') }}" class="block px-4 py-3 rounded-lg font-bold {{ request()->routeIs('galleries.*') ? 'bg-yayasan text-white' : 'text-gray-700 hover:bg-gray-50' }}">{{ __('Galeri') }}</a>
                <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-lg font-bold {{ request()->routeIs('contact') ? 'bg-yayasan text-white' : 'text-gray-700 hover:bg-gray-50' }}">{{ __('Hubungi Kami') }}</a>
                <div class="mt-4 pt-4 border-t border-gray-100 px-4">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Language / Bahasa</p>
                    <div class="grid grid-cols-2 gap-3">
                        {{-- Tombol Indonesia --}}
                        <a href="{{ route('lang.switch', 'id') }}" 
                        class="flex items-center justify-center gap-2 px-3 py-2 rounded-lg border {{ app()->getLocale() == 'id' ? 'bg-yayasan/10 border-yayasan text-yayasan ring-1 ring-yayasan' : 'bg-white border-gray-200 text-gray-600' }}">
                            <img src="https://flagcdn.com/w20/id.png" width="20" class="rounded-sm shadow-sm">
                            <span class="text-sm font-bold">Indonesia</span>
                        </a>

                        {{-- Tombol English --}}
                        <a href="{{ route('lang.switch', 'en') }}" 
                        class="flex items-center justify-center gap-2 px-3 py-2 rounded-lg border {{ app()->getLocale() == 'en' ? 'bg-yayasan/10 border-yayasan text-yayasan ring-1 ring-yayasan' : 'bg-white border-gray-200 text-gray-600' }}">
                            <img src="https://flagcdn.com/w20/gb.png" width="20" class="rounded-sm shadow-sm">
                            <span class="text-sm font-bold">English</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow pt-[72px] md:pt-[104px]"> 
        @yield('content')
    </main>
    @unless(request()->routeIs('ppdb.register') || request()->routeIs('contacts.index'))
        @include('components.cta-section')
    @endunless

    <footer class="bg-yayasan-dark text-white pt-16 pb-8 border-t-4 border-gold">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
            <div>
                <div class="mb-6 bg-white w-fit p-3 rounded-lg shadow-md inline-block">
                    <img src="{{ asset('images/logo-yayasan.png') }}" alt="Logo Yayasan Daar Al Ihsan" class="h-16 w-auto">
                </div>
                <div class="mb-6 bg-white w-fit p-3 rounded-lg shadow-md inline-block">
                    <img src="{{ asset('images/logomiha.png') }}" alt="Logo Yayasan Mabadi'ul Ihsan" class="h-14 w-auto">
                </div>

                <div class="flex flex-col items-start justify-center group cursor-default">
                    <span class="text-[10px] font-bold text-white/80 uppercase tracking-[0.2em] leading-none mb-1 group-hover:text-white transition-colors">
                        {{ __('Terakreditasi') }}
                    </span>
                    <div class="flex items-baseline gap-1">
                        <span class="text-6xl font-serif font-extrabold text-gold leading-none drop-shadow-md group-hover:scale-110 transition-transform origin-left">
                            A
                        </span>
                        <span class="pl-2 text-xs font-bold text-gold/80 uppercase tracking-wider">
                            {{ __('Unggul') }}
                        </span>
                    </div>
                </div>
            </div>
            
            <div>
                <h4 class="font-bold text-gold mb-4 uppercase tracking-wider text-sm">{{ __('Akses Cepat') }}</h4>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a href="#" class="hover:text-white transition">{{ __('Profil Sekolah') }}</a></li>
                    <li><a href="" class="hover:text-white transition">{{ __('LMS Sekolah') }}</a></li>
                    <li><a href="#" class="hover:text-white transition">{{ __('Sistem Akademik') }}</a></li>
                    <li><a href="#" class="hover:text-white transition">{{ __('Manajemen Laboratorium') }}</a></li>
                    <li><a href="#" class="hover:text-white transition">{{ __('Jurnal Guru') }}</a></li>
                    <li><a href="#" class="hover:text-white transition">{{ __('Penerimaan Siswa') }}</a></li>
                    <li><a href="#" class="hover:text-white transition">{{ __('Program Unggulan') }}</a></li>
                    <li><a href="#" class="hover:text-white transition">{{ __('Berita & Artikel') }}</a></li>
                    <li><a href="#" class="hover:text-white transition">{{ __('Kalender Akademik') }}</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-gold mb-4 uppercase tracking-wider text-sm">{{ __('Program Kami') }}</h4>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a href="#" class="hover:text-white transition">{{ __('Cambridge Curriculum') }}</a></li>
                    <li><a href="#" class="hover:text-white transition">{{ __('Tahfidz Al-Quran') }}</a></li>
                    <li><a href="#" class="hover:text-white transition">{{ __('Pesantren Modern') }}</a></li>
                    <li><a href="#" class="hover:text-white transition">{{ __('Programming Class') }}</a></li>
                    <li><a href="#" class="hover:text-white transition">{{ __('Robotika') }}</a></li>
                    <li><a href="#" class="hover:text-white transition">{{ __('Olimpiade') }}</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-gold mb-4 uppercase tracking-wider text-sm">{{ __('Hubungi Kami') }}</h4>
                <ul class="space-y-4 text-sm text-gray-300 mb-6">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gold shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Karangdoro, Tegalsari, Banyuwangi, Jawa Timur</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span>0897-3266-517</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>smpplus.cordova@gmail.com</span>
                    </li>
                </ul>

                @php
                    $brochureLink = $setting?->brochure ? asset('storage/' . $setting->brochure) : '#';
                    $hasBrochure = !empty($setting?->brochure);
                @endphp

                <a href="{{ $brochureLink }}" 
                target="{{ $hasBrochure ? '_blank' : '_self' }}"
                class="group flex items-center justify-center gap-3 w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg {{ $hasBrochure ? 'hover:bg-gold hover:border-gold hover:text-yayasan-dark cursor-pointer' : 'opacity-50 cursor-not-allowed' }} transition-all duration-300">
                    
                    <div class="p-1.5 bg-white/10 rounded-md group-hover:bg-yayasan/20 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    </div>
                    
                    <div class="text-left">
                        <span class="block text-xs text-gray-400 group-hover:text-yayasan-dark/70 uppercase tracking-wide">
                            {{ $hasBrochure ? __('Informasi Lengkap') : __('Belum Tersedia') }}
                        </span>
                        <span class="block font-bold text-white group-hover:text-yayasan-dark leading-none">
                            {{ $hasBrochure ? __('Lihat Brosur Sekolah') : __('Brosur Segera Hadir') }}
                        </span>
                    </div>
                </a>
            </div>
        </div>
        <section class="py-14" style="background-color: #800000; border-top: 1px solid rgba(255,255,255,0.1);">
            <div class="container mx-auto px-4">
                <div class="flex flex-col items-center">
                    
                    <h4 class="text-amber-400 font-bold tracking-[0.4em] uppercase text-[10px] mb-12 opacity-90">
                        {{ __('Didukung Oleh') }}
                    </h4>
                    
                    <div class="flex flex-wrap justify-center items-center gap-x-12 gap-y-8 md:gap-x-20">
                        @foreach($partners as $partner)
                            <div class="flex items-center justify-center h-12"> @if($partner->website)
                                    <a href="{{ $partner->website }}" target="_blank" class="block group">
                                @else
                                    <div class="block group">
                                @endif
                                
                                    <img src="{{ asset('storage/' . $partner->logo) }}" 
                                        alt="{{ $partner->name }}" 
                                        class="max-h-10 md:max-h-12 w-auto object-contain brightness-0 invert opacity-70 group-hover:opacity-100 transition-all duration-300">
                                
                                @if($partner->website)
                                    </a>
                                @else
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    
                </div>
            </div>
        </section>
        <div class="container mx-auto px-4 pt-8 border-t border-white/10 text-center text-sm text-gray-400">
            &copy; {{ date('Y') }} Satria Yudha Pratama | satrify.my.id | SMP Plus Cordova. All rights reserved.
        </div>
    </footer>
    {{-- === FLOATING BUTTONS (WhatsApp & Back to Top) === --}}
    <div x-data="{ showBackToTop: false }" 
         @scroll.window="showBackToTop = (window.pageYOffset > 300)"
         class="fixed bottom-6 right-6 z-50 flex flex-col gap-4 items-end">

        {{-- 1. Tombol WhatsApp (Selalu Muncul) --}}
        @php
            // Ambil nomor dari database SchoolSetting, atau gunakan default
            $phoneRaw = $setting->phone ?? '628973266517';
            
            // Format nomor agar sesuai API WhatsApp (ganti 08 jadi 628, hapus spasi/strip)
            $phoneClean = preg_replace('/[^0-9]/', '', $phoneRaw);
            if(substr($phoneClean, 0, 1) == '0') {
                $phoneClean = '62' . substr($phoneClean, 1);
            }
        @endphp

        <a href="https://wa.me/{{ $phoneClean }}?text=Assalamualaikum,%20saya%20ingin%20bertanya%20tentang%20info%20sekolah..." 
           target="_blank" 
           class="group flex items-center justify-center w-12 h-12 md:w-14 md:h-14 bg-[#25D366] text-white rounded-full shadow-lg hover:bg-[#128C7E] hover:scale-110 transition-all duration-300 relative">
            
            {{-- Tooltip (Muncul saat hover di desktop) --}}
            <span class="absolute right-full mr-3 bg-white text-gray-800 text-xs font-bold px-3 py-1.5 rounded-lg shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap hidden md:block pointer-events-none">
                Chat Admin
            </span>
            
            {{-- Icon WhatsApp --}}
            <svg class="w-6 h-6 md:w-8 md:h-8 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.008-.57-.008-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
        </a>

        {{-- 2. Tombol Back to Top (Muncul saat scroll > 300px) --}}
        <button x-show="showBackToTop"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-10"
                @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                class="flex items-center justify-center w-10 h-10 md:w-12 md:h-12 bg-yayasan text-white rounded-full shadow-lg border border-gold hover:bg-gold hover:text-yayasan-dark hover:-translate-y-1 transition-all duration-300 group"
                aria-label="Kembali ke atas">
            
            <svg class="w-5 h-5 md:w-6 md:h-6 transform group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
        </button>

    </div>
</body>
</html>