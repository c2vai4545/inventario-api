<?php

namespace App\Http\Controllers;

use App\Estado;
use Illuminate\Http\Request;

/**
 * Clase EstadoController
 * 
 * Este controlador maneja las operaciones CRUD para los estados en el sistema.
 */
class EstadoController extends Controller
{
    /**
     * Muestra una lista de todos los estados.
     *
     * @return \Illuminate\Http\Response Respuesta JSON con todos los estados.
     */
    public function index()
    {
        $estados = Estado::all();
        return response()->json($estados);
    }

    /**
     * Almacena un nuevo estado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP con los datos del estado.
     * @return \Illuminate\Http\Response Respuesta JSON con el estado creado y código de estado 201.
     */
    public function store(Request $request)
    {
        $estado = Estado::create($request->all());
        return response()->json($estado, 201);
    }

    /**
     * Muestra un estado específico.
     *
     * @param  int  $id El ID del estado a mostrar.
     * @return \Illuminate\Http\Response Respuesta JSON con los datos del estado.
     */
    public function show($id)
    {
        $estado = Estado::findOrFail($id);
        return response()->json($estado);
    }

    /**
     * Actualiza un estado específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP con los datos actualizados.
     * @param  int  $id El ID del estado a actualizar.
     * @return \Illuminate\Http\Response Respuesta JSON con el estado actualizado.
     */
    public function update(Request $request, $id)
    {
        $estado = Estado::findOrFail($id);
        $estado->update($request->all());
        return response()->json($estado);
    }

    /**
     * Elimina un estado específico de la base de datos.
     *
     * @param  int  $id El ID del estado a eliminar.
     * @return \Illuminate\Http\Response Respuesta JSON vacía con código de estado 204.
     */
    public function destroy($id)
    {
        $estado = Estado::findOrFail($id);
        $estado->delete();
        return response()->json(null, 204);
    }
}
