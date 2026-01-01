@extends('layouts.app')

@section('title', 'Fasilitas Sekolah')

@section('content')
    {{-- Header Page --}}
    <x-header-page 
        :title="__('Fasilitas Sekolah')"
        :subtitle="__('Subtitle Fasilitas')"
        :breadcrumb="__('Fasilitas')" 
    />

    {{-- Main Content dengan Alpine Data untuk Lightbox --}}
    <section class="py-20 bg-gray-50" x-data="{ 
        imgModalOpen: false, 
        imgModalSrc: '', 
        imgModalTitle: '' 
    }">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($facilities->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 xl:gap-10">
                    @foreach($facilities as $facility)
                        {{-- Card Item --}}
                        <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-gray-100 flex flex-col h-full">
                            
                            {{-- Image Area --}}
                            <div class="relative h-64 overflow-hidden cursor-pointer"
                                 {{-- PERBAIKAN 1: Judul untuk Modal (AlpineJS) --}}
                                 @click="imgModalOpen = true; imgModalSrc = '{{ asset('storage/' . $facility->file_path) }}'; imgModalTitle = '{{ addslashes($facility->getTranslation('title', app()->getLocale())) }}'">
                                
                                {{-- PERBAIKAN 2: Alt Text Gambar --}}
                                <img src="{{ asset('storage/' . $facility->file_path) }}" 
                                     alt="{{ $facility->getTranslation('title', app()->getLocale()) }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                     loading="lazy">
                                
                                {{-- Overlay Icon (Eye) --}}
                                <div class="absolute inset-0 bg-gray-900/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                                    <div class="bg-white/90 p-3 rounded-full text-gray-800 shadow-lg transform scale-75 group-hover:scale-100 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Content Area --}}
                            <div class="p-8 flex flex-col flex-grow">
                                {{-- PERBAIKAN 3: Judul Card --}}
                                <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-primary-600 transition-colors">
                                    {{ $facility->getTranslation('title', app()->getLocale()) }}
                                </h3>
                                <div class="w-12 h-1 bg-primary-500 rounded-full mb-4"></div>
                                {{-- PERBAIKAN 4: Deskripsi Card --}}
                                <p class="text-gray-600 text-sm leading-relaxed flex-grow">
                                    {{ $facility->getTranslation('description', app()->getLocale()) ?? 'Fasilitas penunjang pendidikan berkualitas untuk kenyamanan seluruh santri SMP Plus Cordova.' }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Empty State --}}
                <div class="flex flex-col items-center justify-center py-24 text-center">
                    <div class="bg-white p-6 rounded-full shadow-lg mb-6 ring-1 ring-gray-100">
                        <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Fasilitas Ditambahkan</h3>
                    <p class="text-gray-500 max-w-md">Data fasilitas sekolah sedang dalam proses pembaharuan. Silakan kembali lagi nanti.</p>
                </div>
            @endif
        </div>

        {{-- Lightbox / Image Modal --}}
        <div x-show="imgModalOpen" 
             style="display: none;"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @keydown.escape.window="imgModalOpen = false"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-sm">
            
            <button @click="imgModalOpen = false" class="absolute top-6 right-6 text-white hover:text-gray-300 z-50 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div @click.away="imgModalOpen = false" class="max-w-5xl w-full max-h-[90vh] relative">
                <img :src="imgModalSrc" :alt="imgModalTitle" class="w-full h-auto max-h-[85vh] object-contain rounded-lg shadow-2xl mx-auto">
                <p x-text="imgModalTitle" class="text-center text-white mt-4 text-lg font-medium tracking-wide"></p>
            </div>
        </div>

    </section>
@endsection