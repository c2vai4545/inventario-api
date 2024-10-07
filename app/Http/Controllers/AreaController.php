<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

/**
 * Clase AreaController
 * 
 * Este controlador maneja las operaciones CRUD para las áreas en el sistema.
 */
class AreaController extends Controller
{
    /**
     * Muestra una lista de todas las áreas.
     *
     * @return \Illuminate\Http\Response Respuesta JSON con todas las áreas.
     */
    public function index()
    {
        $areas = Area::all();
        return response()->json($areas);
    }

    /**
     * Almacena una nueva área en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP con los datos del área.
     * @return \Illuminate\Http\Response Respuesta JSON con el área creada y código de estado 201.
     */
    public function store(Request $request)
    {
        $area = Area::create($request->all());
        return response()->json($area, 201);
    }

    /**
     * Muestra un área específica.
     *
     * @param  int  $id El ID del área a mostrar.
     * @return \Illuminate\Http\Response Respuesta JSON con los datos del área.
     */
    public function show($id)
    {
        $area = Area::findOrFail($id);
        return response()->json($area);
    }

    /**
     * Actualiza un área específica en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP con los datos actualizados.
     * @param  int  $id El ID del área a actualizar.
     * @return \Illuminate\Http\Response Respuesta JSON con el área actualizada.
     */
    public function update(Request $request, $id)
    {
        $area = Area::findOrFail($id);
        $area->update($request->all());
        return response()->json($area);
    }

    /**
     * Elimina un área específica de la base de datos.
     *
     * @param  int  $id El ID del área a eliminar.
     * @return \Illuminate\Http\Response Respuesta JSON vacía con código de estado 204.
     */
    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();
        return response()->json(null, 204);
    }
}
