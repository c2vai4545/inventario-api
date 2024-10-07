<?php

namespace App\Http\Controllers;

use App\TipoEquipo;
use Illuminate\Http\Request;

/**
 * Clase TipoEquipoController
 * 
 * Este controlador maneja las operaciones CRUD para los tipos de equipo en el sistema.
 */
class TipoEquipoController extends Controller
{
    /**
     * Muestra una lista de todos los tipos de equipo.
     *
     * @return \Illuminate\Http\Response Respuesta JSON con todos los tipos de equipo.
     */
    public function index()
    {
        $tiposEquipo = TipoEquipo::all();
        return response()->json($tiposEquipo);
    }

    /**
     * Almacena un nuevo tipo de equipo en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP con los datos del tipo de equipo.
     * @return \Illuminate\Http\Response Respuesta JSON con el tipo de equipo creado y código de estado 201.
     */
    public function store(Request $request)
    {
        $tipoEquipo = TipoEquipo::create($request->all());
        return response()->json($tipoEquipo, 201);
    }

    /**
     * Muestra un tipo de equipo específico.
     *
     * @param  int  $id El ID del tipo de equipo a mostrar.
     * @return \Illuminate\Http\Response Respuesta JSON con los datos del tipo de equipo.
     */
    public function show($id)
    {
        $tipoEquipo = TipoEquipo::findOrFail($id);
        return response()->json($tipoEquipo);
    }

    /**
     * Actualiza un tipo de equipo específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP con los datos actualizados.
     * @param  int  $id El ID del tipo de equipo a actualizar.
     * @return \Illuminate\Http\Response Respuesta JSON con el tipo de equipo actualizado.
     */
    public function update(Request $request, $id)
    {
        $tipoEquipo = TipoEquipo::findOrFail($id);
        $tipoEquipo->update($request->all());
        return response()->json($tipoEquipo);
    }

    /**
     * Elimina un tipo de equipo específico de la base de datos.
     *
     * @param  int  $id El ID del tipo de equipo a eliminar.
     * @return \Illuminate\Http\Response Respuesta JSON vacía con código de estado 204.
     */
    public function destroy($id)
    {
        $tipoEquipo = TipoEquipo::findOrFail($id);
        $tipoEquipo->delete();
        return response()->json(null, 204);
    }
}
