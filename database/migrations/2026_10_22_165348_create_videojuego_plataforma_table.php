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
        Schema::create('videojuego_plataforma', function (Blueprint $table) {
            $table->foreignId('id_videojuego')->constrained('videojuegos', 'id_videojuego')->cascadeOnDelete();
            $table->foreignId('id_plataforma')->constrained('plataformas', 'id_plataforma')->cascadeOnDelete();
            $table->primary(['id_videojuego', 'id_plataforma']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videojuego_plataforma');
    }
};
