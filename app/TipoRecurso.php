<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase TipoRecurso
 * 
 * Esta clase representa un tipo de recurso en el sistema.
 */
class TipoRecurso extends Model
{
    /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'tipos_recurso';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * Obtiene los inventarios asociados con este tipo de recurso.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }
}
