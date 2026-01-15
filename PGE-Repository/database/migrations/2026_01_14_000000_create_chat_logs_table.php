<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Reset struktur agar sesuai desain terbaru (data utama ada di Dialogflow)
        Schema::dropIfExists('chat_logs');
        Schema::dropIfExists('chat_sessions');

        Schema::create('chat_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->unique();
            $table->timestamp('session_start')->nullable();
            $table->timestamp('session_end')->nullable();
            $table->timestamps();
        });

        Schema::create('chat_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id'); // FK ke chat_sessions.id
            $table->string('detected_intent')->nullable();
            $table->string('sender'); // user / bot / admin (string bebas)
            $table->timestamp('timestamp')->nullable();
            $table->text('message_text')->nullable();
            $table->timestamps();

            $table->foreign('chat_id')
                ->references('id')
                ->on('chat_sessions')
                ->onDelete('cascade');

            $table->index(['chat_id', 'timestamp']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_logs');
        Schema::dropIfExists('chat_sessions');
    }
};


