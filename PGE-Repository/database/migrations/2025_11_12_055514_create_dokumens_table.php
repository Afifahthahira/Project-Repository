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
        Schema::create('dokumens', function (Blueprint $table) {
            $table->increments('id_dokumen');
            $table->text('dokumen');
            $table->unsignedInteger('id_kategori')->nullable();
            $table->unsignedInteger('id_rak')->nullable();
            $table->string('no_versi', 50)->nullable();
            $table->string('status', 50)->nullable;
            $table->string('tahun_masuk', 10)->nullable;
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('id_kategori')
                ->references('id_kategori')
                ->on('kategoris')
                ->onDelete('cascade');

            $table->foreign('id_rak')
                ->references('id_rak')
                ->on('raks')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
