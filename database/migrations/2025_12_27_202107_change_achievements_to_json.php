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
        Schema::table('achievements', function (Blueprint $table) {
            $table->text('title')->change();      // Nama Lomba
            $table->text('recipient')->change();  // Nama Pemenang
            $table->text('rank')->nullable()->change(); // Juara 1 / 1st Place
            $table->text('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke string jika rollback
        Schema::table('achievements', function (Blueprint $table) {
            $table->string('title')->change();
            $table->string('recipient')->change();
            $table->string('rank')->nullable()->change();
            $table->text('description')->nullable()->change();
        });
    }
};
