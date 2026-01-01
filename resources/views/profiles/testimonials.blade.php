@extends('layouts.app')

@section('title', 'Testimoni Alumni & Orang Tua')

@section('content')
    <x-header-page 
        :title="__('Apa Kata Mereka')"
        :subtitle="__('Subtitle Testimoni')"
        :breadcrumb="__('Testimoni')" 
    />
<section class="py-20 bg-neutral-50">
    <div class="container mx-auto px-4">
        @if(session('success'))
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-transition 
                 class="mb-8 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-r-xl flex justify-between items-center shadow-sm">
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-green-500 hover:text-green-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $testi)
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-neutral-100 flex flex-col h-full">
                <div class="flex items-center gap-4 mb-6">
                    <img src="{{ $testi->photo ? asset('storage/' . $testi->photo) : asset('images/default-avatar.png') }}" 
                         class="w-14 h-14 rounded-full object-cover border-2 border-gold">
                    <div>
                        {{-- Nama tetap teks biasa --}}
                        <h4 class="font-bold text-yayasan leading-none">{{ $testi->name }}</h4>
                        {{-- PERBAIKAN 1: Role (JSON) --}}
                        <p class="text-xs text-gold font-bold uppercase tracking-wider mt-1">
                            {{ $testi->getTranslation('role', app()->getLocale()) }}
                        </p>
                    </div>
                </div>
                
                {{-- PERBAIKAN 2: Content (JSON) --}}
                <p class="text-neutral-600 italic flex-grow">
                    "{{ $testi->getTranslation('content', app()->getLocale()) }}"
                </p>
                
                <div class="mt-6 pt-6 border-t border-neutral-50 flex justify-between items-center">
                    <div class="flex text-yellow-400">
                        @for($i=0; $i < ($testi->rating ?? 5); $i++)
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <span class="text-xs text-neutral-400">{{ $testi->created_at->format('d M Y') }}</span>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-12">
            {{ $testimonials->links() }}
        </div>
        <div class="text-center mb-12">
            <button onclick="document.getElementById('modalForm').classList.remove('hidden')" 
                    class="px-8 py-3 bg-yayasan text-white font-bold rounded-full hover:bg-gold cursor-pointer transition duration-300 shadow-lg">
                {{ __('Tulis Testimoni') }}
            </button>
        </div>

        <div id="modalForm" class="fixed inset-0 z-[100] hidden overflow-y-auto bg-black/60 backdrop-blur-sm">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="bg-white rounded-3xl shadow-2xl max-w-lg w-full p-8 relative animate-slide-in">
                    <button onclick="document.getElementById('modalForm').classList.add('hidden')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>

                    <h3 class="text-2xl font-bold text-yayasan mb-2">{{ __('Kirim Testimoni') }}</h3>
                    <p class="text-sm text-gray-500 mb-6">{{ __('Deskripsi Form Testimoni') }}</p>

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-xl">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('profile.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">{{ __('Nama Lengkap') }}</label>
                            <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-gold outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">{{ __('Status Label') }}</label>
                            <input type="text" name="role" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-gold outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">{{ __('Rating') }}</label>
                            <select name="rating" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-gold outline-none transition">
                                <option value="5">{{ __('Sangat Puas') }}</option>
                                <option value="4">{{ __('Puas') }}</option>
                                <option value="3">{{ __('Cukup') }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">{{ __('Isi Testimoni') }}</label>
                            <textarea name="content" rows="4" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-gold outline-none transition"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">{{ __('Foto Profil Label') }}</label>
                            <input type="file" name="photo" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yayasan/10 file:text-yayasan hover:file:bg-gold/20">
                        </div>
                        <button type="submit" class="w-full py-3 bg-yayasan text-white font-bold rounded-xl hover:bg-gold transition shadow-md cursor-pointer">
                            {{ __('Kirim Sekarang') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection