/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                // Palet Warna Yayasan (Berdasarkan Logo DAI)
                yayasan: {
                    DEFAULT: '#800000', // Marun Gelap (Warna Dominan Logo)
                    light: '#A52A2A',   // Marun Terang untuk hover
                    dark: '#5a0000',    // Marun sangat gelap untuk footer
                },
                // Warna Aksen (Kesan Mahal/Elegan)
                gold: {
                    DEFAULT: '#D4AF37', // Emas metalik
                    light: '#F4C430',
                },
                // Warna Netral (Modern & Bersih)
                neutral: {
                    50: '#F9FAFB',  // Background utama (Putih agak abu sangat tipis)
                    900: '#111827', // Teks utama (Bukan hitam pekat, agar nyaman dibaca)
                }
            },
            fontFamily: {
                // Kita akan setup font nanti, rekomendasi: 'Inter' atau 'Plus Jakarta Sans'
                sans: ['Figtree', 'sans-serif'],
                serif: ['Merriweather', 'serif'], // Untuk nuansa "Adab/Pesantren"
            }
        },
    },
    plugins: [],
};