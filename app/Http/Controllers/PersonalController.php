<?php

namespace App\Http\Controllers;

use App\Personal;
use Illuminate\Http\Request;

/**
 * Clase PersonalController
 * 
 * Este controlador maneja las operaciones CRUD para el personal en el sistema.
 */
class PersonalController extends Controller
{
    /**
     * Muestra una lista de todo el personal.
     *
     * @return \Illuminate\Http\Response Respuesta JSON con todo el personal.
     */
    public function index()
    {
        $personal = Personal::all();
        return response()->json($personal);
    }

    /**
     * Almacena un nuevo miembro del personal en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP con los datos del personal.
     * @return \Illuminate\Http\Response Respuesta JSON con el personal creado y código de estado 201.
     */
    public function store(Request $request)
    {
        $personal = Personal::create($request->all());
        return response()->json($personal, 201);
    }

    /**
     * Muestra un miembro del personal específico.
     *
     * @param  int  $id El ID del miembro del personal a mostrar.
     * @return \Illuminate\Http\Response Respuesta JSON con los datos del personal.
     */
    public function show($id)
    {
        $personal = Personal::findOrFail($id);
        return response()->json($personal);
    }

    /**
     * Actualiza un miembro del personal específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP con los datos actualizados.
     * @param  int  $id El ID del miembro del personal a actualizar.
     * @return \Illuminate\Http\Response Respuesta JSON con el personal actualizado.
     */
    public function update(Request $request, $id)
    {
        $personal = Personal::findOrFail($id);
        $personal->update($request->all());
        return response()->json($personal);
    }

    /**
     * Elimina un miembro del personal específico de la base de datos.
     *
     * @param  int  $id El ID del miembro del personal a eliminar.
     * @return \Illuminate\Http\Response Respuesta JSON vacía con código de estado 204.
     */
    public function destroy($id)
    {
        $personal = Personal::findOrFail($id);
        $personal->delete();
        return response()->json(null, 204);
    }
}
