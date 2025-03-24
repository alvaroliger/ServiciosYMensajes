<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('title'); // Título del servicio
            $table->text('description'); // Descripción del servicio
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Referencia al ID del usuario
            $table->decimal('price', 7, 2); // Precio del servicio
            $table->integer('duration'); // Duración del servicio en días
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('status'); // Estado del servicio (activo, inactivo, etc.)
            $table->timestamps(); // created_at y updated_at
            $table->index('user_id');
            $table->index('category_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
}
