<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase TipoEquipo
 * 
 * Esta clase representa un tipo de equipo en el sistema.
 */
class TipoEquipo extends Model
{
    /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'tipos_equipo';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * Obtiene los inventarios asociados con este tipo de equipo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }
}