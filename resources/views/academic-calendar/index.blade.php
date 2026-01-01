@extends('layouts.app')

@section('title', 'Kalender Akademik')

@section('content')
    <x-header-page 
        :title="__('Kalender Akademik')"
        :subtitle="__('Subtitle Kalender')"
        :breadcrumb="__('Kalender Akademik')"
    />

    <section class="py-16 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4">
            
            @if($events->count() > 0)
                @foreach($events as $month => $agendas)
                    <div class="mb-12 relative">
                        <div class="flex items-center gap-4 mb-6 sticky top-[80px] z-20 bg-gray-50/95 py-2 backdrop-blur-sm">
                            <div class="w-3 h-3 rounded-full bg-gold"></div>
                            <h2 class="text-2xl font-bold text-yayasan font-serif">{{ $month }}</h2>
                            <div class="h-px bg-gray-200 flex-1"></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($agendas as $agenda)
                                <div class="group bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover:border-gold/50 hover:shadow-lg transition-all duration-300 flex flex-row gap-5 items-start relative overflow-hidden h-full">
                                    
                                    <div class="absolute left-0 top-0 bottom-0 w-1.5 {{ $agenda->is_holiday ? 'bg-red-500' : 'bg-gold' }}"></div>

                                    <div class="flex-shrink-0 text-center bg-gray-50 rounded-lg p-3 min-w-[85px] border border-gray-100 group-hover:bg-white transition-colors">
                                        <span class="block text-2xl font-bold {{ $agenda->is_holiday ? 'text-red-500' : 'text-gray-800' }}">
                                            {{ \Carbon\Carbon::parse($agenda->start_date)->format('d') }}
                                        </span>
                                        
                                        @if($agenda->end_date && $agenda->end_date != $agenda->start_date)
                                            <div class="w-full h-px bg-gray-300 my-1"></div>
                                            <span class="block text-xl font-bold {{ $agenda->is_holiday ? 'text-red-500' : 'text-gray-800' }}">
                                                {{ \Carbon\Carbon::parse($agenda->end_date)->format('d') }}
                                            </span>
                                        @endif

                                        <span class="block text-[10px] uppercase font-bold text-gray-400 mt-1 tracking-wider">
                                            {{ \Carbon\Carbon::parse($agenda->start_date)->translatedFormat('M') }}
                                        </span>
                                    </div>

                                    <div class="flex-1 py-1">
                                        <div class="flex items-start justify-between gap-2">
                                            <h3 class="text-lg font-bold {{ $agenda->is_holiday ? 'text-red-600' : 'text-gray-900' }} group-hover:text-yayasan transition-colors leading-snug">
                                                {{ $agenda->title }}
                                            </h3>
                                            @if($agenda->is_holiday)
                                                <span class="shrink-0 text-[10px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full uppercase tracking-wider font-bold">Libur</span>
                                            @endif
                                        </div>
                                        
                                        @if($agenda->end_date && $agenda->end_date != $agenda->start_date)
                                            <div class="flex items-center gap-1 mt-2 text-xs font-semibold text-gold">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                {{ \Carbon\Carbon::parse($agenda->start_date)->translatedFormat('d F') }} - {{ \Carbon\Carbon::parse($agenda->end_date)->translatedFormat('d F Y') }}
                                            </div>
                                        @endif

                                        @if($agenda->description)
                                            <p class="text-gray-500 text-sm mt-2 line-clamp-2 leading-relaxed">{{ $agenda->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-24">
                    <div class="inline-block p-6 rounded-full bg-gray-100 text-gray-400 mb-6">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700">Belum ada agenda</h3>
                    <p class="text-gray-500 mt-2">Jadwal akademik tahun ini belum dipublikasikan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection