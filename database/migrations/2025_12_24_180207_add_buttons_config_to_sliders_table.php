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
            // Opsi Tab Baru untuk Tombol 1 (yang sudah ada)
            $table->boolean('open_new_tab')->default(false)->after('button_link');

            // Tombol 2 (Baru)
            $table->string('button2_text')->nullable()->after('open_new_tab');
            $table->string('button2_link')->nullable()->after('button2_text');
            $table->boolean('button2_new_tab')->default(false)->after('button2_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn(['open_new_tab', 'button2_text', 'button2_link', 'button2_new_tab']);
        });
    }
};
