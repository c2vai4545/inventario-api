<?php

namespace App\Http\Controllers;

use App\Ubicacion;
use Illuminate\Http\Request;

/**
 * Clase UbicacionController
 * 
 * Este controlador maneja las operaciones CRUD para las ubicaciones en el sistema.
 */
class UbicacionController extends Controller
{
    /**
     * Muestra una lista de todas las ubicaciones.
     *
     * @return \Illuminate\Http\Response Respuesta JSON con todas las ubicaciones.
     */
    public function index()
    {
        $ubicaciones = Ubicacion::all();
        return response()->json($ubicaciones);
    }

    /**
     * Almacena una nueva ubicación en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP con los datos de la ubicación.
     * @return \Illuminate\Http\Response Respuesta JSON con la ubicación creada y código de estado 201.
     */
    public function store(Request $request)
    {
        $ubicacion = Ubicacion::create($request->all());
        return response()->json($ubicacion, 201);
    }

    /**
     * Muestra una ubicación específica.
     *
     * @param  int  $id El ID de la ubicación a mostrar.
     * @return \Illuminate\Http\Response Respuesta JSON con los datos de la ubicación.
     */
    public function show($id)
    {
        $ubicacion = Ubicacion::findOrFail($id);
        return response()->json($ubicacion);
    }

    /**
     * Actualiza una ubicación específica en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP con los datos actualizados.
     * @param  int  $id El ID de la ubicación a actualizar.
     * @return \Illuminate\Http\Response Respuesta JSON con la ubicación actualizada.
     */
    public function update(Request $request, $id)
    {
        $ubicacion = Ubicacion::findOrFail($id);
        $ubicacion->update($request->all());
        return response()->json($ubicacion);
    }

    /**
     * Elimina una ubicación específica de la base de datos.
     *
     * @param  int  $id El ID de la ubicación a eliminar.
     * @return \Illuminate\Http\Response Respuesta JSON vacía con código de estado 204.
     */
    public function destroy($id)
    {
        $ubicacion = Ubicacion::findOrFail($id);
        $ubicacion->delete();
        return response()->json(null, 204);
    }
}
