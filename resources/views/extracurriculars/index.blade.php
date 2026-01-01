@extends('layouts.app')

@section('title', 'Ekstrakurikuler')

@section('content')
    <x-header-page 
        :title="__('Ekstrakurikuler')"
        :subtitle="__('Deskripsi Ekskul')"
        :breadcrumb="__('Ekstrakurikuler')" 
    />

    <section class="py-16 bg-gray-50 min-h-screen" 
             x-data="{ 
                modalOpen: false,
                selected: { name: '', desc: '', image: '', schedule: '' }
             }">
             
        <div class="container mx-auto px-4">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($extracurriculars as $ekskul)
                    <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-gold/40 flex flex-col h-full">
                        
                        <div class="aspect-[4/3] overflow-hidden bg-gray-200 relative">
                            @if($ekskul->image)
                                {{-- PERBAIKAN 1: Alt Text menggunakan getTranslation --}}
                                <img src="{{ asset('storage/' . $ekskul->image) }}" 
                                     alt="{{ $ekskul->getTranslation('name', app()->getLocale()) }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300 bg-gray-100">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </div>

                        <div class="p-8 flex-1 flex flex-col">
                            <div class="w-12 h-1 bg-gold rounded-full mb-6 group-hover:w-20 transition-all duration-500"></div>

                            {{-- PERBAIKAN 2: Judul --}}
                            <h3 class="text-2xl font-serif font-bold text-gray-900 mb-3 group-hover:text-yayasan transition-colors">
                                {{ $ekskul->getTranslation('name', app()->getLocale()) }}
                            </h3>
                            
                            {{-- PERBAIKAN 3: Deskripsi Singkat --}}
                            <p class="text-gray-500 text-sm leading-relaxed mb-6 font-light flex-1 line-clamp-3">
                                {{ $ekskul->getTranslation('description', app()->getLocale()) ?? 'Program pengembangan diri unggulan sekolah.' }}
                            </p>

                            <div class="mt-auto pt-6 border-t border-gray-50">
                                <button 
                                    type="button" 
                                    @click="
                                        modalOpen = true; 
                                        selected = { 
                                            /* PERBAIKAN 4 (CRITICAL): Data untuk Modal Popup (Javascript) */
                                            name: '{{ addslashes($ekskul->getTranslation('name', app()->getLocale())) }}', 
                                            desc: '{{ addslashes($ekskul->getTranslation('description', app()->getLocale()) ?? 'Belum ada deskripsi.') }}',
                                            image: '{{ asset('storage/' . $ekskul->image) }}',
                                            schedule: '{{ addslashes($ekskul->getTranslation('schedule', app()->getLocale()) ?? 'Menunggu Jadwal') }}'
                                        }
                                    "
                                    class="cursor-pointer inline-flex items-center text-sm font-bold text-yayasan uppercase tracking-widest group-hover:text-gold transition-colors gap-2 focus:outline-none">
                                    {{ __('Lihat Detail') }}
                                    <svg class="w-4 h-4 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        {{-- MODAL POPUP --}}
        <div x-show="modalOpen" 
             style="display: none;"
             class="fixed inset-0 z-50 flex items-center justify-center px-4"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm cursor-pointer" @click="modalOpen = false"></div>

            <div class="bg-white w-full max-w-4xl rounded-3xl shadow-2xl overflow-hidden relative transform transition-all"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4">

                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="h-64 md:h-auto bg-gray-100 relative">
                        <img :src="selected.image" class="w-full h-full object-cover">
                    </div>

                    <div class="p-8 md:p-12 flex flex-col justify-center relative bg-white">
                        <button type="button" @click="modalOpen = false" class="cursor-pointer absolute top-4 right-4 p-2 bg-gray-100 hover:bg-gray-200 rounded-full transition-colors text-gray-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>

                        <div class="w-16 h-1 bg-gold rounded-full mb-6"></div>
                        
                        <h2 class="text-3xl md:text-4xl font-serif font-bold text-yayasan mb-6" x-text="selected.name"></h2>
                        
                        <div class="flex items-center gap-3 mb-6 bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <div class="w-10 h-10 rounded-full bg-gold/10 flex items-center justify-center text-gold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">{{ __('Jadwal Latihan') }}</p>
                                <p class="text-gray-900 font-bold" x-text="selected.schedule"></p>
                            </div>
                        </div>

                        <p class="text-gray-600 leading-relaxed text-lg font-light" x-text="selected.desc"></p>
                        
                    </div>
                </div>

            </div>
        </div>

    </section>
@endsection