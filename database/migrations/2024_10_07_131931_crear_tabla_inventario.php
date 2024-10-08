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
    public function up(): void
    {
        // Creación de la tabla tipos_recurso
        Schema::create('tipos_recurso', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Creación de la tabla areas
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Creación de la tabla especialidades
        Schema::create('especialidades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Creación de la tabla tipos_equipo
        Schema::create('tipos_equipo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Creación de la tabla marcas
        Schema::create('marcas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Creación de la tabla estados
        Schema::create('estados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Creación de la tabla ubicaciones
        Schema::create('ubicaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // Creación de la tabla personal
        Schema::create('personal', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->timestamps();
        });

        // Creación de la tabla inventario
        Schema::create('inventario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_recurso_id')->constrained('tipos_recurso');
            $table->foreignId('area_id')->constrained('areas');
            $table->foreignId('especialidad_id')->nullable()->constrained('especialidades');
            $table->foreignId('tipo_equipo_id')->constrained('tipos_equipo');
            $table->foreignId('marca_id')->constrained('marcas');
            $table->string('modelo');
            $table->string('procesador')->nullable();
            $table->string('ram')->nullable();
            $table->string('disco_duro')->nullable();
            $table->string('serie');
            $table->string('cod_patrimonial')->nullable();
            $table->foreignId('estado_id')->constrained('estados');
            $table->foreignId('ubicacion_id')->constrained('ubicaciones');
            $table->foreignId('personal_id')->nullable()->constrained('personal');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones.
     *
     * Elimina todas las tablas creadas en orden inverso para evitar problemas de claves foráneas.
     *
     * @return void
     */
    public function down(): void
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
