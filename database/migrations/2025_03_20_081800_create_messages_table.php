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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade'); // Relación con conversación
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Usuario que envía el mensaje
            $table->text('body'); // Contenido del mensaje
            $table->timestamp('read_at')->nullable(); // Marca de leído
            $table->timestamps();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
