<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase Estado
 * 
 * Esta clase representa un estado de equipo en el sistema.
 */
class Estado extends Model
{
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * Obtiene los inventarios asociados con este estado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }
}