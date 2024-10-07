<?php

namespace App\Http\Controllers;

use App\Marca;
use Illuminate\Http\Request;

/**
 * Clase MarcaController
 * 
 * Este controlador maneja las operaciones CRUD para las marcas en el sistema.
 */
class MarcaController extends Controller
{
    /**
     * Muestra una lista de todas las marcas.
     *
     * @return \Illuminate\Http\Response Respuesta JSON con todas las marcas.
     */
    public function index()
    {
        $marcas = Marca::all();
        return response()->json($marcas);
    }

    /**
     * Almacena una nueva marca en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP con los datos de la marca.
     * @return \Illuminate\Http\Response Respuesta JSON con la marca creada y código de estado 201.
     */
    public function store(Request $request)
    {
        $marca = Marca::create($request->all());
        return response()->json($marca, 201);
    }

    /**
     * Muestra una marca específica.
     *
     * @param  int  $id El ID de la marca a mostrar.
     * @return \Illuminate\Http\Response Respuesta JSON con los datos de la marca.
     */
    public function show($id)
    {
        $marca = Marca::findOrFail($id);
        return response()->json($marca);
    }

    /**
     * Actualiza una marca específica en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request La solicitud HTTP con los datos actualizados.
     * @param  int  $id El ID de la marca a actualizar.
     * @return \Illuminate\Http\Response Respuesta JSON con la marca actualizada.
     */
    public function update(Request $request, $id)
    {
        $marca = Marca::findOrFail($id);
        $marca->update($request->all());
        return response()->json($marca);
    }

    /**
     * Elimina una marca específica de la base de datos.
     *
     * @param  int  $id El ID de la marca a eliminar.
     * @return \Illuminate\Http\Response Respuesta JSON vacía con código de estado 204.
     */
    public function destroy($id)
    {
        $marca = Marca::findOrFail($id);
        $marca->delete();
        return response()->json(null, 204);
    }
}
