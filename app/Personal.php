<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase Personal
 * 
 * Esta clase representa a un miembro del personal en el sistema.
 */
class Personal extends Model
{
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'apellido'];

    /**
     * Obtiene los inventarios asociados con este miembro del personal.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }
}