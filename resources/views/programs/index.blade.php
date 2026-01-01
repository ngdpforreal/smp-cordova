@extends('layouts.app')

@section('title', 'Program Unggulan')

@section('content')
    <x-header-page 
        :title="__('Program Pendidikan')"
        :subtitle="__('Deskripsi Program')"
        :breadcrumb="__('Program Pendidikan')" 
    />

    <section class="py-24 bg-neutral-50 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-full h-full opacity-[0.03] pointer-events-none" 
             style="background-image: radial-gradient(#800000 1px, transparent 1px); background-size: 30px 30px;">
        </div>

        <div class="container mx-auto px-4 relative z-10">
            
            @foreach($programs as $index => $program)
                <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20 mb-24 last:mb-0">
                    
                    <div class="w-full lg:w-1/2 {{ $index % 2 == 1 ? 'lg:order-2' : '' }}">
                        <div class="relative group">
                            <div class="absolute -top-4 -left-4 w-2/3 h-2/3 bg-gold/20 rounded-3xl -z-10 transition-transform duration-500 group-hover:translate-x-2 group-hover:translate-y-2"></div>
                            <div class="absolute -bottom-4 -right-4 w-2/3 h-2/3 bg-yayasan/10 rounded-3xl -z-10 transition-transform duration-500 group-hover:-translate-x-2 group-hover:-translate-y-2"></div>
                            
                            <div class="relative aspect-[4/3] bg-white rounded-3xl overflow-hidden shadow-xl border-4 border-white">
                                @if($program->image)
                                    {{-- PERBAIKAN 1: Alt Text --}}
                                    <img src="{{ asset('storage/' . $program->image) }}" 
                                         alt="{{ $program->getTranslation('title', app()->getLocale()) }}" 
                                         class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full bg-gray-50 flex items-center justify-center text-gray-300">
                                        <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"></path></svg>
                                    </div>
                                @endif

                                <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-md px-4 py-2 rounded-xl shadow-lg border border-white/50">
                                    <span class="text-xs font-bold text-yayasan uppercase tracking-widest">{{ __('Program Unggulan') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full lg:w-1/2 {{ $index % 2 == 1 ? 'lg:order-1' : '' }}">
                        <div class="flex flex-col items-start">
                            
                            <div class="w-16 h-16 rounded-2xl bg-white shadow-md border border-gray-100 flex items-center justify-center text-gold mb-6 group hover:bg-yayasan hover:text-white transition-colors duration-300">
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
                                    @default
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                @endswitch
                            </div>
                            
                            {{-- PERBAIKAN 2: Judul --}}
                            <h2 class="text-3xl lg:text-4xl font-serif font-bold text-yayasan mb-4">
                                {{ $program->getTranslation('title', app()->getLocale()) }}
                            </h2>
                            
                            <div class="w-20 h-1 bg-gold rounded-full mb-6"></div>
                            
                            <div class="prose prose-lg text-gray-600 leading-relaxed mb-8">
                                {{-- PERBAIKAN 3: Deskripsi --}}
                                <p>{{ $program->getTranslation('description', app()->getLocale()) }}</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8 w-full">
                                <div class="flex items-center gap-3 p-3 bg-white rounded-lg border border-gray-100 shadow-sm">
                                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <span class="text-sm font-bold text-gray-700">{{ __('Kurikulum Unggulan') }}</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-white rounded-lg border border-gray-100 shadow-sm">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    </div>
                                    <span class="text-sm font-bold text-gray-700">{{ __('Pengajar Profesional') }}</span>
                                </div>
                            </div>

                            {{-- PERBAIKAN 4: Link WA dengan Judul Program yang diterjemahkan --}}
                            <a href="https://wa.me/6281234567890?text=Assalamualaikum,%20saya%20tertarik%20dengan%20program%20{{ urlencode($program->getTranslation('title', app()->getLocale())) }}" 
                               target="_blank"
                               class="inline-flex items-center gap-2 px-8 py-3 bg-yayasan text-white font-bold rounded-full hover:bg-gold hover:text-yayasan-dark transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                <span>{{ __('Tanya Program') }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    </section>
@endsection