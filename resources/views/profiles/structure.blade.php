@extends('layouts.app')

@section('title', 'Struktur Organisasi')

@section('content')
    <x-header-page 
        :title="__('Struktur Organisasi')"
        :subtitle="__('Mengenal Lebih Dekat')"
        :breadcrumb="__('Struktur Organisasi')"
    />

    <section class="py-16 bg-white" 
             x-data="{ 
                modalOpen: false, 
                selected: { 
                    name: '', position: '', photo: '', bio: '', 
                    education: '', cv: '', fb: '', ig: '', in: '' 
                } 
             }">
             
        <div class="container mx-auto px-4">
            
            {{-- === BAGIAN PIMPINAN === --}}
            @if($pimpinan->count() > 0)
                <div class="mb-24"> 
                    <div class="text-center mb-12">
                        <span class="text-gray-400 font-bold tracking-[0.2em] uppercase text-[10px]">{{ __('Struktural') }}</span>
                        <h2 class="text-2xl font-serif font-bold text-gray-900 mt-1">{{ __('Pimpinan Sekolah') }}</h2>
                        <div class="w-12 h-1 bg-gray-200 mx-auto mt-3 rounded-full"></div>
                    </div>
                    
                    <div class="flex flex-col gap-10 max-w-5xl mx-auto">
                        @foreach($pimpinan as $p)
                            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 flex flex-col md:flex-row group hover:shadow-lg transition-all duration-500">
                                
                                <div class="w-full md:w-2/5 relative h-[400px] md:h-auto overflow-hidden bg-gray-50">
                                    @if($p->photo)
                                        <img src="{{ asset('storage/' . $p->photo) }}" alt="{{ $p->name }}" class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                            <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>
                                        </div>
                                    @endif
                                </div>

                                <div class="w-full md:w-3/5 p-8 md:p-12 flex flex-col justify-center relative bg-white">
                                    
                                    <svg class="absolute top-6 right-8 w-20 h-20 text-gray-50 transform rotate-180 font-serif" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 8.44772 14.017 9V11C14.017 11.5523 13.5693 12 13.017 12H12.017V5H22.017V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM5.0166 21L5.0166 18C5.0166 16.8954 5.91203 16 7.0166 16H10.0166C10.5689 16 11.0166 15.5523 11.0166 15V9C11.0166 8.44772 10.5689 8 10.0166 8H6.0166C5.46432 8 5.0166 8.44772 5.0166 9V11C5.0166 11.5523 4.56889 12 4.0166 12H3.0166V5H13.0166V15C13.0166 18.3137 10.3303 21 7.0166 21H5.0166Z"></path></svg>

                                    <div class="relative z-10">
                                        {{-- PERBAIKAN 1: Posisi (JSON) --}}
                                        <span class="inline-block py-1 px-3 rounded-full bg-gold/5 text-gold font-bold tracking-widest uppercase text-[10px] mb-4 border border-gold/20">
                                            {{ $p->getTranslation('position', app()->getLocale()) }}
                                        </span>
                                        
                                        <h3 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 mb-6 leading-tight">
                                            {{ $p->name }}
                                        </h3>

                                        {{-- PERBAIKAN 2: Bio (JSON & Strip Tags) --}}
                                        <p class="text-gray-600 text-lg italic leading-relaxed mb-8 font-light">
                                            "{!! Str::limit(strip_tags($p->getTranslation('bio', app()->getLocale()) ?? 'Assalamualaikum Warahmatullahi Wabarakatuh.'), 250) !!}"
                                        </p>

                                        {{-- PERBAIKAN 3: Data Modal (AlpineJS) --}}
                                        <button @click="modalOpen = true; selected = {
                                                name: '{{ addslashes($p->name) }}',
                                                position: '{{ addslashes($p->getTranslation('position', app()->getLocale())) }}',
                                                photo: '{{ $p->photo ? asset('storage/'.$p->photo) : '' }}',
                                                bio: '{{ addslashes(strip_tags($p->getTranslation('bio', app()->getLocale()) ?? '-')) }}',
                                                education: '{{ addslashes($p->education ?? '-') }}',
                                                cv: '{{ $p->cv_file ? asset('storage/'.$p->cv_file) : '' }}',
                                                fb: '{{ $p->facebook }}',
                                                ig: '{{ $p->instagram }}',
                                                in: '{{ $p->linkedin }}'
                                            }" 
                                            class="cursor-pointer inline-flex items-center gap-2 text-sm font-bold text-yayasan uppercase tracking-wider hover:text-gold transition-colors group/btn">
                                            {{ __('Baca Sambutan Lengkap') }}
                                            <svg class="w-4 h-4 transform group-hover/btn:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- === BAGIAN GURU === --}}
            @if($guru->count() > 0)
                <div class="mb-20">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="h-px bg-gray-100 flex-1"></div>
                        <h2 class="text-lg font-serif font-bold text-gray-800 uppercase tracking-widest">{{ __('Dewan Guru') }}</h2>
                        <div class="h-px bg-gray-100 flex-1"></div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-5 lg:grid-cols-6 xl:grid-cols-7 gap-4">
                        @foreach($guru as $g)
                            <div @click="modalOpen = true; selected = {
                                    name: '{{ addslashes($g->name) }}',
                                    position: '{{ addslashes($g->getTranslation('position', app()->getLocale())) }}',
                                    photo: '{{ $g->photo ? asset('storage/'.$g->photo) : '' }}',
                                    bio: '{{ addslashes(strip_tags($g->getTranslation('bio', app()->getLocale()) ?? '-')) }}',
                                    education: '{{ addslashes($g->education ?? '-') }}',
                                    cv: '{{ $g->cv_file ? asset('storage/'.$g->cv_file) : '' }}',
                                    fb: '{{ $g->facebook }}',
                                    ig: '{{ $g->instagram }}',
                                    in: '{{ $g->linkedin }}'
                                }"
                                class="bg-white rounded-xl overflow-hidden border border-gray-100 shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] hover:shadow-lg hover:border-gray-300 hover:-translate-y-1 transition-all duration-300 group cursor-pointer relative">
                                
                                <div class="aspect-[3/4] overflow-hidden bg-gray-50 relative">
                                    @if($g->photo)
                                        <img src="{{ asset('storage/' . $g->photo) }}" class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-110">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-50 text-gray-300">
                                            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="p-3 text-center">
                                    <h3 class="font-bold text-gray-900 text-sm leading-snug mb-0.5 group-hover:text-yayasan transition-colors line-clamp-2">{{ $g->name }}</h3>
                                    {{-- PERBAIKAN: Posisi --}}
                                    <p class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">{{ $g->getTranslation('position', app()->getLocale()) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- === BAGIAN STAFF === --}}
            @if($staff->count() > 0)
                <div class="mb-12">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="h-px bg-gray-100 flex-1"></div>
                        <h2 class="text-base font-serif font-bold text-gray-600 uppercase tracking-widest">Staff & Tata Usaha</h2>
                        <div class="h-px bg-gray-100 flex-1"></div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-5 lg:grid-cols-6 xl:grid-cols-7 gap-4">
                        @foreach($staff as $s)
                            <div @click="modalOpen = true; selected = {
                                    name: '{{ addslashes($s->name) }}',
                                    position: '{{ addslashes($s->getTranslation('position', app()->getLocale())) }}',
                                    photo: '{{ $s->photo ? asset('storage/'.$s->photo) : '' }}',
                                    bio: '{{ addslashes(strip_tags($s->getTranslation('bio', app()->getLocale()) ?? '-')) }}',
                                    education: '{{ addslashes($s->education ?? '-') }}',
                                    cv: '{{ $s->cv_file ? asset('storage/'.$s->cv_file) : '' }}',
                                    fb: '{{ $s->facebook }}',
                                    ig: '{{ $s->instagram }}',
                                    in: '{{ $s->linkedin }}'
                                }"
                                class="bg-white rounded-xl overflow-hidden border border-gray-100 shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] hover:shadow-lg hover:border-gray-300 hover:-translate-y-1 transition-all duration-300 group cursor-pointer relative">
                                
                                <div class="aspect-[3/4] overflow-hidden bg-gray-50 relative">
                                    @if($s->photo)
                                        <img src="{{ asset('storage/' . $s->photo) }}" class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-110">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-50 text-gray-300">
                                            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="p-3 text-center">
                                    <h3 class="font-bold text-gray-900 text-sm leading-snug mb-0.5 group-hover:text-yayasan transition-colors line-clamp-2">{{ $s->name }}</h3>
                                    {{-- PERBAIKAN: Posisi --}}
                                    <p class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">{{ $s->getTranslation('position', app()->getLocale()) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- === MODAL POPUP === --}}
            <div x-show="modalOpen" 
                 style="display: none;"
                 class="fixed inset-0 z-[999] flex items-center justify-center px-4"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
                
                <div class="absolute inset-0 bg-black/60 backdrop-blur-sm cursor-pointer" @click="modalOpen = false"></div>

                <div class="bg-white w-full max-w-4xl rounded-3xl shadow-2xl overflow-hidden relative transform transition-all flex flex-col md:flex-row max-h-[90vh]"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 translate-y-4">

                    <button @click="modalOpen = false" class="cursor-pointer absolute top-4 right-4 z-20 p-2 bg-white/20 backdrop-blur-md rounded-full text-white md:text-gray-500 md:bg-gray-100 md:hover:bg-gray-200 hover:bg-white/40 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>

                    <div class="w-full md:w-2/5 h-64 md:h-auto bg-gray-200 relative shrink-0">
                        <template x-if="selected.photo">
                            <img :src="selected.photo" class="w-full h-full object-cover object-top">
                        </template>
                        <template x-if="!selected.photo">
                            <div class="w-full h-full flex flex-col items-center justify-center bg-gray-100 text-gray-400">
                                <svg class="w-20 h-20 mb-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>
                                <span class="text-sm font-bold">No Photo Available</span>
                            </div>
                        </template>
                        <div class="absolute inset-0 bg-gradient-to-t from-yayasan-dark/80 via-transparent to-transparent md:hidden"></div>
                        <div class="absolute bottom-4 left-4 text-white md:hidden">
                            <h2 class="text-xl font-bold font-serif" x-text="selected.name"></h2>
                            <p class="text-gold text-sm font-medium" x-text="selected.position"></p>
                        </div>
                    </div>

                    <div class="w-full md:w-3/5 p-8 md:p-10 bg-white overflow-y-auto">
                        <div class="hidden md:block mb-6">
                            <h2 class="text-3xl font-serif font-bold text-gray-900 mb-2 leading-tight" x-text="selected.name"></h2>
                            <div class="inline-block px-3 py-1 bg-gold text-white font-bold text-sm uppercase tracking-wide rounded-md" x-text="selected.position"></div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                                    Pendidikan Terakhir
                                </h4>
                                <p class="text-gray-800 font-medium text-lg" x-text="selected.education || '-'"></p>
                            </div>

                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Tentang Saya / Sambutan
                                </h4>
                                <p class="text-gray-600 leading-relaxed text-sm" x-text="selected.bio || '-'"></p>
                            </div>

                            <div x-show="selected.fb || selected.ig || selected.in">
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Media Sosial</h4>
                                <div class="flex gap-4">
                                    <template x-if="selected.fb">
                                        <a :href="'https://facebook.com/' + selected.fb" target="_blank" class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                        </a>
                                    </template>
                                    <template x-if="selected.ig">
                                        <a :href="'https://instagram.com/' + selected.ig" target="_blank" class="w-10 h-10 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center hover:bg-pink-600 hover:text-white transition-all">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z"/>
                                            </svg>
                                        </a>
                                    </template>
                                    <template x-if="selected.in">
                                        <a :href="'https://linkedin.com/in/' + selected.in" target="_blank" class="w-10 h-10 rounded-full bg-blue-800 text-white flex items-center justify-center hover:bg-blue-900 transition-all">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-xs text-gray-400 font-medium">Informasi resmi dari sekolah</span>
                            
                            <template x-if="selected.cv">
                                <a :href="selected.cv" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-yayasan text-white rounded-xl font-bold shadow-lg hover:bg-gold hover:text-yayasan-dark transition-all duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    Lihat CV / Portfolio
                                </a>
                            </template>
                            <template x-if="!selected.cv">
                                <button disabled class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 text-gray-400 rounded-xl font-bold cursor-not-allowed">
                                    CV Tidak Tersedia
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection