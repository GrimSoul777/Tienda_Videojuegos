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
        Schema::create('resenas', function (Blueprint $table) {
            $table->id('id_resena');
            $table->foreignId('id_cliente')->constrained('clientes', 'id_cliente')->cascadeOnDelete();
            $table->foreignId('id_videojuego')->constrained('videojuegos', 'id_videojuego')->cascadeOnDelete();
            $table->integer('calificacion');
            $table->text('comentario')->nullable();
            $table->timestamp('fecha')->useCurrent();
            $table->unique(['id_cliente', 'id_videojuego']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resenas');
    }
};
