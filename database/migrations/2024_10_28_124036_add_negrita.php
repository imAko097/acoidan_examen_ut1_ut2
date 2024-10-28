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
        // Añade la columna "negrita" a la base de datos
        Schema::table('messages', function (Blueprint $table) {
            $table->boolean('negrita') -> after('subrayado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Elimina la columna subrayado a la base de datos (rollback)
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('negrita');
        });
    }
};
