<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase Marca
 * 
 * Esta clase representa una marca de equipo en el sistema.
 */
class Marca extends Model
{
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * Obtiene los inventarios asociados con esta marca.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }
}