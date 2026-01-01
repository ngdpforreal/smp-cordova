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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // Headline besar
            $table->string('subtitle')->nullable(); // Teks kecil di bawah headline
            $table->string('image'); // Background gambar
            $table->string('button_text')->nullable(); // Teks tombol (misal: "Selengkapnya")
            $table->string('button_link')->nullable(); // Link tombol
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
