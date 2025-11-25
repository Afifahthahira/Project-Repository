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
        Schema::create('aktivitas', function (Blueprint $table) {
            $table->id('id_aktivitas');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('dokumen_id');
            $table->string('action'); // contoh: download, view, upload, edit
            $table->timestamps();

            // RELATION

            $table->foreign('user_id')
                ->references('id_user')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('dokumen_id')
                ->references('id_dokumen')
                ->on('dokumens')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas');
    }
};
