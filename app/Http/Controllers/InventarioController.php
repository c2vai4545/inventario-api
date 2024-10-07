<?php

namespace App\Http\Controllers;

use App\Inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Estado;
use App\Personal;

/**
 * Controlador para manejar operaciones relacionadas con el inventario.
 */
class InventarioController extends Controller
{
    /**
     * Muestra una lista de todos los elementos del inventario.
     *
     * @return \Illuminate\Http\Response Respuesta JSON con todos los elementos del inventario.
     */
    public function index()
    {
        $inventarios = Inventario::with(['tipoRecurso', 'area', 'especialidad', 'tipoEquipo', 'marca', 'estado', 'ubicacion', 'personal'])->get();
        return response()->json($inventarios);
    }

    /**
     * Almacena un nuevo elemento en el inventario.
     *
     * @param  \Illuminate\Http\Request  $request Datos del nuevo elemento.
     * @return \Illuminate\Http\Response Respuesta JSON con el elemento creado y código de estado 201.
     */
    public function store(Request $request)
    {
        $tipoRecurso = \App\TipoRecurso::firstOrCreate(['nombre' => $request->tipo_recurso]);
        $area = \App\Area::firstOrCreate(['nombre' => $request->area]);
        $especialidad = \App\Especialidad::firstOrCreate(['nombre' => $request->especialidad]);
        $tipoEquipo = \App\TipoEquipo::firstOrCreate(['nombre' => $request->tipo_equipo]);
        $marca = \App\Marca::firstOrCreate(['nombre' => $request->marca]);
        $estado = \App\Estado::firstOrCreate(['nombre' => $request->estado]);
        $ubicacion = \App\Ubicacion::firstOrCreate(['nombre' => $request->ubicacion]);

        $nombreCompleto = explode(' ', trim($request->personal), 2);
        $nombre = $nombreCompleto[0];
        $apellido = isset($nombreCompleto[1]) ? $nombreCompleto[1] : '';
        $personal = \App\Personal::firstOrCreate(
            ['nombre' => $nombre, 'apellido' => $apellido]
        );

        $inventario = Inventario::create([
            'tipo_recurso_id' => $tipoRecurso->id,
            'area_id' => $area->id,
            'especialidad_id' => $especialidad->id,
            'tipo_equipo_id' => $tipoEquipo->id,
            'marca_id' => $marca->id,
            'modelo' => $request->modelo,
            'procesador' => $request->procesador,
            'ram' => $request->ram,
            'disco_duro' => $request->disco_duro,
            'serie' => $request->serie,
            'cod_patrimonial' => $request->cod_patrimonial,
            'estado_id' => $estado->id,
            'ubicacion_id' => $ubicacion->id,
            'personal_id' => $personal->id,
            'observaciones' => $request->observaciones,
        ]);

        return response()->json($inventario, 201);
    }

    /**
     * Muestra un elemento específico del inventario.
     *
     * @param  int  $id Identificador del elemento.
     * @return \Illuminate\Http\Response Respuesta JSON con el elemento solicitado.
     */
    public function show($id)
    {
        $inventario = Inventario::with(['tipoRecurso', 'area', 'especialidad', 'tipoEquipo', 'marca', 'estado', 'ubicacion', 'personal'])->findOrFail($id);
        return response()->json($inventario);
    }

    /**
     * Actualiza un elemento específico en el inventario.
     *
     * @param  \Illuminate\Http\Request  $request Datos actualizados del elemento.
     * @param  int  $id Identificador del elemento a actualizar.
     * @return \Illuminate\Http\Response Respuesta JSON con el elemento actualizado.
     */
    public function update(Request $request, $id)
    {
        $inventario = Inventario::findOrFail($id);
        $inventario->update($request->all());
        return response()->json($inventario);
    }

    /**
     * Cambia el estado de un elemento específico del inventario a "Baja".
     *
     * @param  int  $id Identificador del elemento.
     * @return \Illuminate\Http\Response Respuesta JSON vacía con código de estado 204.
     */
    public function destroy($id)
    {
        $inventario = Inventario::findOrFail($id);
        $inventario->estado_id = Estado::where('nombre', 'Baja')->first()->id;
        $inventario->save();
        return response()->json(null, 204);
    }
}
