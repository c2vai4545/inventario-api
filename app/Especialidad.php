<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase Especialidad
 * 
 * Esta clase representa una especialidad en el sistema.
 */
class Especialidad extends Model
{
    /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'especialidades';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * Obtiene los inventarios asociados con esta especialidad.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }
}