<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Clase CrearTablaInventario
 * 
 * Esta migración crea las tablas necesarias para el sistema de inventario.
 */
class CrearTablaInventario extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * Crea las siguientes tablas:
     * - tipos_recurso: Almacena los tipos de recursos.
     * - areas: Almacena las áreas de la organización.
     * - especialidades: Almacena las especialidades.
     * - tipos_equipo: Almacena los tipos de equipos.
     * - marcas: Almacena las marcas de los equipos.
     * - estados: Almacena los posibles estados de los equipos.
     * - ubicaciones: Almacena las ubicaciones de los equipos.
     * - personal: Almacena la información del personal.
     * - inventario: Tabla principal que almacena todos los equipos y sus características.
     *
     * @return void
     */
    public function up()
    {
        // Creación de la tabla tipos_recurso
        Schema::create('tipos_recurso', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
        });

        // Creación de la tabla areas
        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
        });

        // Creación de la tabla especialidades
        Schema::create('especialidades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
        });

        // Creación de la tabla tipos_equipo
        Schema::create('tipos_equipo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
        });

        // Creación de la tabla marcas
        Schema::create('marcas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
        });

        // Creación de la tabla estados
        Schema::create('estados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
        });

        // Creación de la tabla ubicaciones
        Schema::create('ubicaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
        });

        // Creación de la tabla personal
        Schema::create('personal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->timestamps();
        });

        // Creación de la tabla inventario
        Schema::create('inventario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_recurso_id')->unsigned();
            $table->integer('area_id')->unsigned();
            $table->integer('especialidad_id')->unsigned()->nullable();
            $table->integer('tipo_equipo_id')->unsigned();
            $table->integer('marca_id')->unsigned();
            $table->string('modelo');
            $table->string('procesador')->nullable();
            $table->string('ram')->nullable();
            $table->string('disco_duro')->nullable();
            $table->string('serie');
            $table->string('cod_patrimonial')->nullable();
            $table->integer('estado_id')->unsigned();
            $table->integer('ubicacion_id')->unsigned();
            $table->integer('personal_id')->unsigned()->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();

            // Definición de claves foráneas
            $table->foreign('tipo_recurso_id')->references('id')->on('tipos_recurso');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('especialidad_id')->references('id')->on('especialidades');
            $table->foreign('tipo_equipo_id')->references('id')->on('tipos_equipo');
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('ubicacion_id')->references('id')->on('ubicaciones');
            $table->foreign('personal_id')->references('id')->on('personal');
        });
    }

    /**
     * Revierte las migraciones.
     *
     * Elimina todas las tablas creadas en orden inverso para evitar problemas de claves foráneas.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventario');
        Schema::dropIfExists('personal');
        Schema::dropIfExists('ubicaciones');
        Schema::dropIfExists('estados');
        Schema::dropIfExists('marcas');
        Schema::dropIfExists('tipos_equipo');
        Schema::dropIfExists('especialidades');
        Schema::dropIfExists('areas');
        Schema::dropIfExists('tipos_recurso');
    }
}
