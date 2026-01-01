<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('extracurriculars', function (Blueprint $table) {
            $table->text('description')->nullable(); // Penjelasan kegiatan
            $table->string('schedule')->nullable();  // Contoh: Senin & Kamis, 15.00
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('extracurriculars', function (Blueprint $table) {
            $table->dropColumn(['description', 'schedule']);
        });
    }
};
