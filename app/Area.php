<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase Area
 * 
 * Esta clase representa un área en el sistema.
 */
class Area extends Model
{
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * Obtiene los inventarios asociados con esta área.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }
}