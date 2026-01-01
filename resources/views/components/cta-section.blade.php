<section class="py-20 relative overflow-hidden bg-amber-50 border-t border-gold/20">
        
        <div class="absolute inset-0 opacity-40 pointer-events-none" 
             style="background-image: radial-gradient(#d4af37 0.5px, transparent 0.5px); background-size: 20px 20px;">
        </div>

        <div class="absolute top-0 left-0 w-64 h-64 bg-gold/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-yayasan/5 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>

        <div class="container mx-auto px-4 relative z-10 text-center">
            
            <div class="max-w-3xl mx-auto">
                <span class="text-gold font-bold tracking-[0.2em] uppercase text-sm mb-2 block">
                    {{ __('PPDB') }}
                </span>
                
                <h2 class="text-3xl md:text-5xl font-serif font-bold text-yayasan mb-6 leading-tight">
                    {{ __('Mari Bergabung Bersama') }} <br> {{ __('Keluarga Besar Kami') }}
                </h2>
                
                <p class="text-gray-600 text-lg mb-10 leading-relaxed font-light">
                    {{ __('Berikan Pendidikan') }}
                </p>
                
                <div class="flex flex-col sm:flex-row gap-5 justify-center items-center">
                    <a href="https://ppdb.ponpesmiha.online" target="_blank" class="group relative px-10 py-4 bg-yayasan text-white font-bold rounded-full overflow-hidden shadow-lg hover:shadow-2xl hover:bg-yayasan-dark transition-all duration-300 hover:-translate-y-1 w-full sm:w-auto">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            {{ __('Daftar Sekarang CTA') }}
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </span>
                    </a>
                    
                    <a href="/profil/program-unggulan" class="px-10 py-4 border-2 border-yayasan text-yayasan font-bold rounded-full hover:bg-yayasan hover:text-white transition-all duration-300 w-full sm:w-auto">
                        {{ __('Konsultasi Program') }}
                    </a>
                </div>

                <p class="mt-6 text-sm text-gray-400 font-medium">
                    {{ __('Kuota terbatas') }}
                </p>
            </div>
            
        </div>
    </section>