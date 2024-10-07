<?php

namespace App\Http\Controllers;

use App\Especialidad;
use Illuminate\Http\Request;

/**
 * Clase EspecialidadController
 * 
 * Este controlador maneja las operaciones CRUD para las especialidades en el sistema.
 */
class EspecialidadController extends Controller
{
    /**
     * Muestra una lista de todas las especialidades.
     *
     * @return \Illuminate\Http\Response Respuesta JSON con todas las especialidades.
     */
    public function index()
    {
        $especialidades = Especialidad::all();
        return response()->json($especialidades);
    }

    /**
     * Almacena una nueva especialidad en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP con los datos de la especialidad.
     * @return \Illuminate\Http\Response Respuesta JSON con la especialidad creada y código de estado 201.
     */
    public function store(Request $request)
    {
        $especialidad = Especialidad::create($request->all());
        return response()->json($especialidad, 201);
    }

    /**
     * Muestra una especialidad específica.
     *
     * @param  int  $id El ID de la especialidad a mostrar.
     * @return \Illuminate\Http\Response Respuesta JSON con los datos de la especialidad.
     */
    public function show($id)
    {
        $especialidad = Especialidad::findOrFail($id);
        return response()->json($especialidad);
    }

    /**
     * Actualiza una especialidad específica en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP con los datos actualizados.
     * @param  int  $id El ID de la especialidad a actualizar.
     * @return \Illuminate\Http\Response Respuesta JSON con la especialidad actualizada.
     */
    public function update(Request $request, $id)
    {
        $especialidad = Especialidad::findOrFail($id);
        $especialidad->update($request->all());
        return response()->json($especialidad);
    }

    /**
     * Elimina una especialidad específica de la base de datos.
     *
     * @param  int  $id El ID de la especialidad a eliminar.
     * @return \Illuminate\Http\Response Respuesta JSON vacía con código de estado 204.
     */
    public function destroy($id)
    {
        $especialidad = Especialidad::findOrFail($id);
        $especialidad->delete();
        return response()->json(null, 204);
    }
}
