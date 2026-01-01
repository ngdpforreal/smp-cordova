<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Program;
use App\Models\Post;
use App\Models\Achievement;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@cordova.sch.id',
            'password' => Hash::make('password'), // Ganti nanti saat production
        ]);

        // 2. Isi Pengaturan Sekolah (Sesuai PDF)
        $settings = [
            ['key' => 'school_name', 'value' => 'SMP Plus Cordova', 'type' => 'text'],
            ['key' => 'yayasan_name', 'value' => "Yayasan Pondok Pesantren Mabadi'ull Ihsan", 'type' => 'text'],
            ['key' => 'tagline', 'value' => 'Mendidik Ilmu, Menanam Adab, Menyiapkan Masa Depan', 'type' => 'text'],
            ['key' => 'address', 'value' => 'Karangdoro, Tegalsari, Banyuwangi', 'type' => 'text'], // Dari Logo SMP
            ['key' => 'phone', 'value' => '0812-3456-7890', 'type' => 'text'],
            ['key' => 'email', 'value' => 'info@cordova.sch.id', 'type' => 'text'],
            ['key' => 'facebook', 'value' => 'https://facebook.com', 'type' => 'text'],
            ['key' => 'instagram', 'value' => 'https://instagram.com', 'type' => 'text'],
            ['key' => 'youtube', 'value' => 'https://youtube.com', 'type' => 'text'],
            
            // Konten Statis
            ['key' => 'history', 'value' => 'SMP Plus Cordova berdiri di bawah naungan Yayasan Pondok Pesantren Mabadi\'ull Ihsan Banyuwangi, mengintegrasikan kurikulum nasional dan nilai-nilai pesantren.', 'type' => 'textarea'],
            ['key' => 'vision', 'value' => 'Menjadi lembaga pendidikan yang unggul dalam IPTEK, kokoh dalam IMTAQ, dan berakhlakul karimah.', 'type' => 'textarea'],
            ['key' => 'mission', 'value' => "1. Menyelenggarakan pendidikan berbasis pesantren.\n2. Mengembangkan potensi siswa melalui kurikulum internasional.\n3. Membentuk karakter santri yang mandiri dan disiplin.", 'type' => 'textarea'],
            ['key' => 'headmaster_name', 'value' => 'Nama Kepala Sekolah', 'type' => 'text'],
            ['key' => 'headmaster_message', 'value' => 'Selamat datang di website resmi SMP Plus Cordova. Kami berkomitmen mencetak generasi yang tidak hanya cerdas secara akademik tetapi juga memiliki adab yang luhur.', 'type' => 'textarea'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }

        // 3. Isi Slider (Hero Section)
        Slider::create([
            'title' => 'Selamat Datang di SMP Plus Cordova',
            'subtitle' => 'Mendidik Ilmu, Menanam Adab',
            'image' => 'slider1.jpg', // Nanti kita siapkan gambarnya
            'button_text' => 'Lihat Profil',
            'button_link' => '/profil',
            'order' => 1
        ]);

        // 4. Isi Program Unggulan
        $programs = [
            ['title' => 'Kelas Internasional', 'description' => 'Menggunakan kurikulum Cambridge untuk persiapan global.', 'icon' => 'globe'],
            ['title' => 'Tahfidz Al-Quran', 'description' => 'Program hafalan Al-Quran terintegrasi dengan jadwal sekolah.', 'icon' => 'book-open'],
            ['title' => 'Sains & Teknologi', 'description' => 'Pengembangan minat bakat dalam bidang robotik dan coding.', 'icon' => 'cpu'],
            ['title' => 'Bahasa Asing', 'description' => 'Penguasaan Bahasa Arab dan Inggris aktif.', 'icon' => 'chat'],
        ];

        foreach ($programs as $prog) {
            Program::create($prog);
        }

        // 5. Dummy Berita
        Post::create([
            'title' => 'Kunjungan Studi Banding ke Banyuwangi',
            'slug' => 'kunjungan-studi-banding',
            'category' => 'berita',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'user_id' => 1,
            'status' => 'published',
            'published_at' => now(),
        ]);
        // 6. Dummy Prestasi
        Achievement::create([
            'title' => 'Juara 1 Robotik Tingkat Provinsi',
            'recipient' => 'Tim Robotik Cordova',
            'rank' => 'Juara 1',
            'level' => 'Provinsi Jawa Timur',
            'year' => '2024',
            'description' => 'Meraih medali emas dalam kategori Line Follower.',
            'image' => null
        ]);

        Achievement::create([
            'title' => 'Gold Medal MTQ Nasional',
            'recipient' => 'Ahmad Fulan',
            'rank' => 'Medali Emas',
            'level' => 'Nasional',
            'year' => '2024',
            'description' => 'Cabang Tilawah Remaja.',
            'image' => null
        ]);

        // 7. Dummy Testimoni
        Testimonial::create([
            'name' => 'Bpk. H. Abdullah',
            'role' => 'Wali Murid',
            'content' => 'Alhamdulillah, sejak sekolah di sini anak saya tidak hanya pinter akademik tapi adabnya sangat santun. Hafalannya juga lancar.',
            'rating' => 5
        ]);

        Testimonial::create([
            'name' => 'Fatimah Az-Zahra',
            'role' => 'Alumni 2022 - Kuliah di Al-Azhar Cairo',
            'content' => 'Bekal bahasa Arab dan Inggris dari SMP Plus Cordova sangat membantu saya saat melanjutkan studi di luar negeri.',
            'rating' => 5
        ]);
    }
}