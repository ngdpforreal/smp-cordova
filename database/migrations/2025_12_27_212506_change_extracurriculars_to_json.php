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
        Schema::table('extracurriculars', function (Blueprint $table) {
            $table->text('name')->change();        // Nama Ekskul
            $table->text('description')->nullable()->change();
            $table->text('schedule')->nullable()->change(); // Jadwal (Senin/Monday)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('extracurriculars', function (Blueprint $table) {
            $table->string('name')->change();
            $table->text('description')->nullable()->change();
            $table->string('schedule')->nullable()->change();
        });
    }
};
