<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase Ubicacion
 * 
 * Esta clase representa una ubicación de equipo en el sistema.
 */
class Ubicacion extends Model
{
    /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'ubicaciones';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * Obtiene los inventarios asociados con esta ubicación.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }
}