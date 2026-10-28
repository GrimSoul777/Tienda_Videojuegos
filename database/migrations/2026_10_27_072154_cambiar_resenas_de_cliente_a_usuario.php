<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resenas', function (Blueprint $table) {
            // Eliminar las restricciones anteriores.
            $table->dropForeign(['id_cliente']);
            $table->dropUnique(['id_cliente', 'id_videojuego']);
        });

        Schema::table('resenas', function (Blueprint $table) {
            // Eliminar la columna que apuntaba a clientes.
            $table->dropColumn('id_cliente');
        });

        Schema::table('resenas', function (Blueprint $table) {
            // Relacionar cada reseña con un usuario.
            $table->foreignId('id_usuario')
                ->constrained('usuarios', 'id_usuario')
                ->cascadeOnDelete();

            // Un usuario solo puede reseñar una vez cada videojuego.
            $table->unique(['id_usuario', 'id_videojuego']);
        });
    }

    public function down(): void
    {
        Schema::table('resenas', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            $table->dropUnique(['id_usuario', 'id_videojuego']);
        });

        Schema::table('resenas', function (Blueprint $table) {
            $table->dropColumn('id_usuario');
        });

        Schema::table('resenas', function (Blueprint $table) {
            $table->foreignId('id_cliente')
                ->constrained('clientes', 'id_cliente')
                ->cascadeOnDelete();

            $table->unique(['id_cliente', 'id_videojuego']);
        });
    }
};
