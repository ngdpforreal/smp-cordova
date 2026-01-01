<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->text('title')->change();        // Judul Headline
            $table->text('subtitle')->nullable()->change(); // Deskripsi
            $table->text('button_text')->nullable()->change(); // Teks Tombol 1
            $table->text('button2_text')->nullable()->change(); // Teks Tombol 2
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->string('title')->change();
            $table->string('subtitle')->nullable()->change();
            $table->string('button_text')->nullable()->change();
            $table->string('button2_text')->nullable()->change();
        });
    }
};
