<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->unsignedInteger('id_divisi')->nullable();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_divisi')
                ->references('id_divisi')
                ->on('divisis')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
