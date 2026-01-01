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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Nama Lomba/Penghargaan
            $table->string('recipient'); // Nama Siswa/Tim
            $table->string('rank')->nullable(); // Juara 1, 2, dll
            $table->string('level')->nullable(); // Kabupaten, Nasional, Internasional
            $table->year('year');
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // Foto penyerahan piala
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
