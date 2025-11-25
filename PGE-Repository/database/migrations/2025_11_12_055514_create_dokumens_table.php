<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumens', function (Blueprint $table) {
            $table->increments('id_dokumen');
            $table->text('judul');
            $table->unsignedInteger('id_company')->nullable();
            $table->unsignedInteger('id_divisi')->nullable();
            $table->unsignedInteger('id_kategori')->nullable();
            $table->unsignedInteger('id_rak')->nullable();
            $table->string('file_path')->nullable();
            $table->string('no_versi', 50)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('tahun_masuk', 10)->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_company')
                ->references('id_company')
                ->on('companies')
                ->onDelete('cascade');

            $table->foreign('id_divisi')
                ->references('id_divisi')
                ->on('divisis')
                ->onDelete('cascade');

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

    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
