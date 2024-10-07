<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase Personal
 * 
 * Esta clase representa a un miembro del personal en el sistema.
 * Extiende de la clase Model de Eloquent para interactuar con la base de datos.
 */
class Personal extends Model
{
    /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'personal';

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

    /**
     * Busca un miembro del personal por su nombre completo o lo crea si no existe.
     *
     * @param string $nombreCompleto El nombre completo del miembro del personal.
     * @return Personal La instancia del modelo Personal encontrada o creada.
     */
    public static function buscarOCrear($nombreCompleto)
    {
        // Divide el nombre completo en nombre y apellido
        $partes = explode(' ', trim($nombreCompleto), 2);
        $nombre = $partes[0];
        $apellido = isset($partes[1]) ? $partes[1] : '';

        // Busca al personal por nombre y apellido
        $personal = self::where('nombre', $nombre)
                        ->where('apellido', $apellido)
                        ->first();

        // Si no se encuentra, crea un nuevo registro
        if (!$personal) {
            $personal = self::create([
                'nombre' => $nombre,
                'apellido' => $apellido
            ]);
        }

        return $personal;
    }
}