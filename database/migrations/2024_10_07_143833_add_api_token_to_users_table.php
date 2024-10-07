<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Clase AddApiTokenToUsersTable
 * 
 * Esta migración agrega la columna 'api_token' a la tabla 'users'.
 */
class AddApiTokenToUsersTable extends Migration
{
    /**
     * Ejecuta la migración.
     *
     * Agrega la columna 'api_token' a la tabla 'users'.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('api_token', 60)->unique()->nullable();
        });
    }

    /**
     * Revierte la migración.
     *
     * Elimina la columna 'api_token' de la tabla 'users'.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('api_token');
        });
    }
}
