@extends('layouts.app')

@section('title', 'Sejarah & Visi Misi')

@section('content')
    <x-header-page 
        :title="__('Sejarah & Visi Misi')"
        :subtitle="__('Subtitle Sejarah')"
        :breadcrumb="__('Profil Sekolah')"
    />

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="relative group">
                    <div class="absolute inset-0 bg-gold rounded-3xl rotate-3 group-hover:rotate-6 transition-transform duration-300"></div>
                    <img src="{{ asset('images/gedung-sekolah.jpg') }}" 
                         alt="Gedung Sekolah" 
                         class="relative rounded-3xl shadow-xl w-full h-[400px] object-cover border-4 border-white"
                         onerror="this.src='https://placehold.co/600x400?text=Foto+Gedung'">
                </div>

                <div>
                    <h2 class="text-3xl font-serif font-bold text-yayasan mb-6 border-l-4 border-gold pl-4">{{ __('Sejarah Singkat') }}</h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed text-justify">
                        {{-- Mengambil Data dari Settings --}}
                        {!! nl2br(e(\App\Models\Setting::where('key', 'profile_history')->value('value') ?? 'Sejarah sekolah belum diisi oleh admin. Silakan input di menu Settings dengan key: profile_history')) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50 border-t border-gray-200">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 text-center group">
                    <div class="w-20 h-20 bg-yayasan/5 rounded-full flex items-center justify-center text-yayasan mx-auto mb-6 group-hover:bg-yayasan group-hover:text-white transition-colors">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-serif font-bold text-yayasan mb-4">{{ __('Visi') }}</h3>
                    <p class="text-gray-600 text-lg italic font-medium">
                        "{{ \App\Models\Setting::where('key', 'profile_vision')->value('value') ?? 'Visi belum diisi (Key: profile_vision)' }}"
                    </p>
                </div>

                <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                    <div class="w-20 h-20 bg-gold/10 rounded-full flex items-center justify-center text-gold mx-auto mb-6 group-hover:bg-gold group-hover:text-white transition-colors">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="text-2xl font-serif font-bold text-yayasan mb-6 text-center">{{ __('Misi') }}</h3>
                    <div class="text-gray-600 space-y-3">
                        @php
                            $missions = explode("\n", \App\Models\Setting::where('key', 'profile_mission')->value('value') ?? "Misi 1\nMisi 2");
                        @endphp
                        
                        <ul class="space-y-3 text-left max-w-md mx-auto">
                            @foreach($missions as $mission)
                                @if(trim($mission) != '')
                                    <li class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-gold mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        <span>{{ $mission }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection