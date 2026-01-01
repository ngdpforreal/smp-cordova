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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Alumni/Wali
            $table->string('role'); // Misal: Alumni 2023 / Wali Murid
            $table->text('content'); // Isi testimoni
            $table->string('photo')->nullable(); // Foto orangnya
            $table->integer('rating')->default(5); // Bintang 1-5
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
