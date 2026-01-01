@props([
    'title', 
    'subtitle', 
    'breadcrumb' => 'Halaman'
])

<div class="relative py-24 overflow-hidden group">
    
    <div class="absolute inset-0 bg-cover bg-center fixed-background transition-transform duration-1000 group-hover:scale-105" 
         style="background-image: url('{{ asset('images/gedung-sekolah.jpg') }}');">
    </div>

    <div class="absolute inset-0 bg-gradient-to-r from-yayasan-dark/95 via-yayasan/80 to-yayasan-dark/80"></div>

    <div class="container mx-auto px-4 relative z-10 text-center text-white">
        <nav class="flex justify-center mb-6 text-sm font-medium text-white/70 uppercase tracking-widest space-x-2">
            <a href="{{ url('/') }}" class="hover:text-gold transition">Beranda</a>
            <span>/</span>
            <span class="text-white">{{ $breadcrumb }}</span>
        </nav>

        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4 tracking-tight drop-shadow-md">
            {{ $title }}
        </h1>
        
        <div class="w-24 h-1 bg-gold mx-auto mb-6 rounded-full shadow-sm"></div>
        
        <p class="text-gray-100 text-lg max-w-2xl mx-auto font-light leading-relaxed drop-shadow-sm">
            {{ $subtitle }}
        </p>
    </div>
</div>