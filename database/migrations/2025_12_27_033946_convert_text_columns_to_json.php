<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // === 1. TABEL POSTS ===
        // Langkah 1: Ubah ke TEXT dulu agar muat saat ditambah format JSON
        Schema::table('posts', function (Blueprint $table) {
            $table->text('title')->change();
            $table->longText('content')->change(); // Content biasanya panjang, pakai longText aman
        });
        
        // Langkah 2: Update Data ke Format JSON
        DB::statement("UPDATE posts SET title = JSON_OBJECT('id', title) WHERE title IS NOT NULL AND title NOT LIKE '{\"%'");
        DB::statement("UPDATE posts SET content = JSON_OBJECT('id', content) WHERE content IS NOT NULL AND content NOT LIKE '{\"%'");
        
        // Langkah 3: Ubah Tipe ke JSON
        Schema::table('posts', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('content')->change();
        });


        // === 2. TABEL SLIDERS ===
        // Langkah 1: Ubah ke TEXT
        Schema::table('sliders', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
            $table->text('subtitle')->nullable()->change();
            $table->text('button_text')->nullable()->change();
            $table->text('button2_text')->nullable()->change();
        });

        // Langkah 2: Update Data
        DB::statement("UPDATE sliders SET title = JSON_OBJECT('id', title) WHERE title IS NOT NULL AND title NOT LIKE '{\"%'");
        DB::statement("UPDATE sliders SET subtitle = JSON_OBJECT('id', subtitle) WHERE subtitle IS NOT NULL AND subtitle NOT LIKE '{\"%'");
        DB::statement("UPDATE sliders SET button_text = JSON_OBJECT('id', button_text) WHERE button_text IS NOT NULL AND button_text NOT LIKE '{\"%'");
        DB::statement("UPDATE sliders SET button2_text = JSON_OBJECT('id', button2_text) WHERE button2_text IS NOT NULL AND button2_text NOT LIKE '{\"%'");

        // Langkah 3: Ubah ke JSON
        Schema::table('sliders', function (Blueprint $table) {
            $table->json('title')->nullable()->change();
            $table->json('subtitle')->nullable()->change();
            $table->json('button_text')->nullable()->change();
            $table->json('button2_text')->nullable()->change();
        });


        // === 3. TABEL PROGRAMS ===
        Schema::table('programs', function (Blueprint $table) {
            $table->text('title')->change();
            $table->longText('description')->change();
        });

        DB::statement("UPDATE programs SET title = JSON_OBJECT('id', title) WHERE title IS NOT NULL AND title NOT LIKE '{\"%'");
        DB::statement("UPDATE programs SET description = JSON_OBJECT('id', description) WHERE description IS NOT NULL AND description NOT LIKE '{\"%'");

        Schema::table('programs', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('description')->change();
        });


        // === 4. TABEL TESTIMONIALS ===
        Schema::table('testimonials', function (Blueprint $table) {
            $table->longText('content')->change();
            $table->text('role')->change();
        });

        DB::statement("UPDATE testimonials SET content = JSON_OBJECT('id', content) WHERE content IS NOT NULL AND content NOT LIKE '{\"%'");
        DB::statement("UPDATE testimonials SET role = JSON_OBJECT('id', role) WHERE role IS NOT NULL AND role NOT LIKE '{\"%'");

        Schema::table('testimonials', function (Blueprint $table) {
            $table->json('content')->change();
            $table->json('role')->change();
        });
        

        // === 5. TABEL EXTRACURRICULARS ===
        Schema::table('extracurriculars', function (Blueprint $table) {
            $table->text('name')->change();
            $table->longText('description')->nullable()->change();
        });

        DB::statement("UPDATE extracurriculars SET name = JSON_OBJECT('id', name) WHERE name IS NOT NULL AND name NOT LIKE '{\"%'");
        DB::statement("UPDATE extracurriculars SET description = JSON_OBJECT('id', description) WHERE description IS NOT NULL AND description NOT LIKE '{\"%'");

        Schema::table('extracurriculars', function (Blueprint $table) {
            $table->json('name')->change();
            $table->json('description')->nullable()->change();
        });
        

        // === 6. TABEL ACHIEVEMENTS ===
        Schema::table('achievements', function (Blueprint $table) {
            $table->text('title')->change();
            $table->longText('description')->nullable()->change();
        });

        DB::statement("UPDATE achievements SET title = JSON_OBJECT('id', title) WHERE title IS NOT NULL AND title NOT LIKE '{\"%'");
        DB::statement("UPDATE achievements SET description = JSON_OBJECT('id', description) WHERE description IS NOT NULL AND description NOT LIKE '{\"%'");

        Schema::table('achievements', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('description')->nullable()->change();
        });


        // === 7. TABEL TEACHERS ===
        Schema::table('teachers', function (Blueprint $table) {
            $table->text('position')->nullable()->change();
            $table->longText('bio')->nullable()->change();
        });

        DB::statement("UPDATE teachers SET position = JSON_OBJECT('id', position) WHERE position IS NOT NULL AND position NOT LIKE '{\"%'");
        DB::statement("UPDATE teachers SET bio = JSON_OBJECT('id', bio) WHERE bio IS NOT NULL AND bio NOT LIKE '{\"%'");

        Schema::table('teachers', function (Blueprint $table) {
            $table->json('position')->nullable()->change();
            $table->json('bio')->nullable()->change();
        });


        // === 8. TABEL GALLERIES ===
        Schema::table('galleries', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
            $table->longText('description')->nullable()->change();
        });

        DB::statement("UPDATE galleries SET title = JSON_OBJECT('id', title) WHERE title IS NOT NULL AND title NOT LIKE '{\"%'");
        DB::statement("UPDATE galleries SET description = JSON_OBJECT('id', description) WHERE description IS NOT NULL AND description NOT LIKE '{\"%'");

        Schema::table('galleries', function (Blueprint $table) {
            $table->json('title')->nullable()->change();
            $table->json('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Fungsi rollback jika terjadi kesalahan (Mengembalikan JSON ke Teks biasa - mengambil ID saja)
        
        // Posts
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title')->change(); // Perhatikan panjang karakter jika sebelumnya varchar
            $table->text('content')->change();
        });
        DB::statement("UPDATE posts SET title = JSON_UNQUOTE(JSON_EXTRACT(title, '$.id')) WHERE title IS NOT NULL");
        DB::statement("UPDATE posts SET content = JSON_UNQUOTE(JSON_EXTRACT(content, '$.id')) WHERE content IS NOT NULL");

        // ... (Lakukan pola yang sama untuk tabel lain jika perlu rollback) ...
        // Untuk mempersingkat, rollback biasanya jarang dipakai di tahap ini kecuali urgent.
    }
};