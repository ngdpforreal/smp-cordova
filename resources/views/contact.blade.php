@extends('layouts.app')

@section('title', __('Hubungi Kami'))

@section('content')
    {{-- Menggunakan Binding :title dan :subtitle --}}
    <x-header-page 
        :title="__('Hubungi Kami')"
        :subtitle="__('Subtitle Kontak')"
        :breadcrumb="__('Hubungi Kami')"
    />

    <section class="py-20 bg-gray-50 relative overflow-hidden">
        {{-- Dekorasi Background --}}
        <div class="absolute top-0 left-0 w-64 h-64 bg-primary-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-green-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 translate-x-1/2 translate-y-1/2"></div>

        <div class="container mx-auto px-4 relative z-10">
            
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20">
                
                {{-- KOLOM KIRI: INFO & MAPS --}}
                <div class="flex flex-col gap-10">
                    
                    {{-- Info Cards --}}
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <span class="w-8 h-1 bg-primary-500 rounded-full"></span>
                            {{ __('Informasi Kontak') }}
                        </h3>
                        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 space-y-6">
                            
                            {{-- Alamat --}}
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-full bg-primary-50 flex items-center justify-center text-primary-600 shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ __('Alamat Sekolah') }}</h4>
                                    <p class="text-gray-600 text-sm mt-1 leading-relaxed">
                                        {{ $setting->address ?? __('Alamat Belum Diatur') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Kontak Telepon & Email --}}
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center text-green-600 shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ __('Telepon & Email') }}</h4>
                                    <div class="text-gray-600 text-sm mt-1 space-y-1">
                                        <p class="flex items-center gap-2">
                                            <span class="font-medium">Telp:</span> {{ $setting->phone ?? '-' }}
                                        </p>
                                        <p class="flex items-center gap-2">
                                            <span class="font-medium">Email:</span> {{ $setting->email ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Social Media --}}
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ __('Media Sosial') }}</h4>
                                    <div class="flex gap-3 mt-2">
                                        @if($setting?->instagram)
                                            <a href="https://instagram.com/{{ $setting->instagram }}" target="_blank" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-pink-500 hover:text-white transition-all">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                            </a>
                                        @endif
                                        
                                        @if($setting?->facebook)
                                            <a href="https://facebook.com/{{ $setting->facebook }}" target="_blank" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-blue-600 hover:text-white transition-all">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                            </a>
                                        @endif

                                        @if($setting?->youtube)
                                            <a href="https://youtube.com/{{ $setting->youtube }}" target="_blank" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-red-600 hover:text-white transition-all">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Google Maps Embed --}}
                    <div class="h-80 w-full rounded-3xl overflow-hidden shadow-sm border border-gray-200 bg-gray-100">
                        @if($setting?->maps_embed)
                            <div class="w-full h-full [&_iframe]:w-full [&_iframe]:h-full">
                                {!! $setting->maps_embed !!}
                            </div>
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 p-6 text-center">
                                <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="font-medium">{{ __('Peta Belum Diatur') }}</span>
                                <span class="text-xs mt-1">{{ __('Instruksi Peta') }}</span>
                            </div>
                        @endif
                    </div>

                </div>

                {{-- KOLOM KANAN: FORMULIR --}}
                <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-xl border border-gray-100 h-fit">
                    
                    <div class="mb-8">
                        <span class="text-primary-600 font-bold tracking-widest uppercase text-xs">{{ __('Formulir Pesan') }}</span>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ __('Kirim Pesan Judul') }}</h3>
                        <p class="text-gray-500 mt-2 text-sm">{{ __('Kirim Pesan Deskripsi') }}</p>
                    </div>

                    {{-- Flash Message Success --}}
                    @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <h4 class="font-bold text-green-800 text-sm">{{ __('Berhasil') }}</h4>
                                <p class="text-green-600 text-xs mt-1">{{ session('success') }}</p>
                            </div>
                            <button @click="show = false" class="ml-auto text-green-400 hover:text-green-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                        @csrf
                        
                        {{-- Nama --}}
                        <div>
                            <label for="name" class="block text-xs font-bold text-gray-700 uppercase mb-2 ml-1">{{ __('Nama Lengkap') }}</label>
                            <input type="text" name="name" id="name" required placeholder="{{ __('Placeholder Nama') }}"
                                   class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all placeholder-gray-400">
                        </div>

                        {{-- Email & Telepon --}}
                        <div class="grid md:grid-cols-2 gap-5">
                            <div>
                                <label for="email" class="block text-xs font-bold text-gray-700 uppercase mb-2 ml-1">
                                    {{ __('Alamat Email') }} <span class="text-gray-400 font-normal lowercase ml-1">{{ __('Opsional') }}</span>
                                </label>
                                <input type="email" name="email" id="email" placeholder="{{ __('Placeholder Email') }}"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all placeholder-gray-400">
                            </div>
                            <div>
                                <label for="phone" class="block text-xs font-bold text-gray-700 uppercase mb-2 ml-1">
                                    {{ __('No WhatsApp') }} <span class="text-gray-400 font-normal lowercase ml-1">{{ __('Opsional') }}</span>
                                </label>
                                <input type="tel" name="phone" id="phone" placeholder="{{ __('Placeholder WA') }}"
                                       class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all placeholder-gray-400">
                            </div>
                        </div>

                        {{-- Kategori --}}
                        <div>
                            <label for="subject" class="block text-xs font-bold text-gray-700 uppercase mb-2 ml-1">{{ __('Kategori Pesan') }}</label>
                            <div class="relative">
                                <select name="subject" id="subject" required
                                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-800 appearance-none focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all cursor-pointer">
                                    <option value="" disabled selected>{{ __('Pilih Tujuan') }}</option>
                                    {{-- Value tetap bahasa asli untuk Database, Tampilan diterjemahkan --}}
                                    <option value="Pertanyaan Umum">{{ __('Tipe Pertanyaan Umum') }}</option>
                                    <option value="PPDB">{{ __('Tipe PPDB') }}</option>
                                    <option value="Kritik & Saran">{{ __('Tipe Kritik') }}</option>
                                    <option value="Lainnya">{{ __('Tipe Lainnya') }}</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        {{-- Pesan --}}
                        <div>
                            <label for="message" class="block text-xs font-bold text-gray-700 uppercase mb-2 ml-1">{{ __('Label Isi Pesan') }}</label>
                            <textarea name="message" id="message" rows="5" required placeholder="{{ __('Placeholder Pesan') }}"
                                      class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all placeholder-gray-400 resize-none"></textarea>
                        </div>

                        {{-- Tombol Kirim --}}
                        <button type="submit" class="cursor-pointer w-full bg-gray-900 text-white font-bold py-4 rounded-xl hover:bg-primary-600 transition-all duration-300 shadow-lg hover:shadow-primary-500/30 flex items-center justify-center gap-2 group">
                            {{ __('Tombol Kirim Pesan') }}
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection