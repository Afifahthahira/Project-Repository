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
        Schema::create('raks', function (Blueprint $table) {
            $table->increments('id_rak');
            $table->string('nama_rak');
            $table->string('posisi')->nullable();
            $table->string('qr_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raks');
    }
};
