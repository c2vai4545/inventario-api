<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * Esta migración agrega una columna 'active' a la tabla 'users'.
     * La columna 'active' es de tipo booleano y tiene un valor predeterminado de true.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Revierte las migraciones.
     *
     * Esta función elimina la columna 'active' de la tabla 'users'.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('active');
        });
    }
};
