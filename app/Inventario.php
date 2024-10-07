<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase Inventario
 * 
 * Esta clase representa un elemento en el inventario del sistema.
 */
class Inventario extends Model
{
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'tipo_recurso_id', 'area_id', 'especialidad_id', 'tipo_equipo_id',
        'marca_id', 'modelo', 'procesador', 'ram', 'disco_duro', 'serie',
        'cod_patrimonial', 'estado_id', 'ubicacion_id', 'personal_id', 'observaciones'
    ];

    /**
     * Obtiene el tipo de recurso asociado con este inventario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoRecurso()
    {
        return $this->belongsTo(TipoRecurso::class);
    }

    /**
     * Obtiene el área asociada con este inventario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Obtiene la especialidad asociada con este inventario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    /**
     * Obtiene el tipo de equipo asociado con este inventario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoEquipo()
    {
        return $this->belongsTo(TipoEquipo::class);
    }

    /**
     * Obtiene la marca asociada con este inventario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    /**
     * Obtiene el estado asociado con este inventario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    /**
     * Obtiene la ubicación asociada con este inventario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    /**
     * Obtiene el personal asociado con este inventario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }
}