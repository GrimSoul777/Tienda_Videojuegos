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
        Schema::create('videojuegos', function (Blueprint $table) {
            $table->id('id_videojuego');
            $table->string('titulo', 150);
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->date('fecha_lanzamiento')->nullable();
            $table->foreignId('id_desarrolladora')->constrained('desarrolladoras', 'id_desarrolladora')->restrictOnDelete();
            $table->foreignId('id_categoria')->constrained('categorias', 'id_categoria')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videojuegos');
    }
};
