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
        Schema::table('contact_messages', function (Blueprint $table) {
            // Kita tambahkan ->nullable() dan ->change()
            // change() berfungsi mengubah kolom yang SUDAH ADA tanpa menghapusnya
            $table->string('email')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            // Kembalikan ke wajib isi (not null) jika di-rollback
            $table->string('email')->nullable(false)->change();
        });
    }
};