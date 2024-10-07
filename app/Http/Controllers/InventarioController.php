<?php

namespace App\Http\Controllers;

use App\Inventario;
use App\Estado;
use Illuminate\Http\Request;

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
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'tipo_recurso' => 'required|string',
            'area' => 'required|string',
            'especialidad' => 'required|string',
            'tipo_equipo' => 'required|string',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'procesador' => 'required|string',
            'ram' => 'required|string',
            'disco_duro' => 'required|string',
            'serie' => 'required|string',
            'cod_patrimonial' => 'required|string',
            'estado' => 'required|string',
            'ubicacion' => 'required|string',
            'personal' => 'required|string',
            'observaciones' => 'nullable|string',
        ]);

        // Buscar o crear registros relacionados
        $tipoRecurso = \App\TipoRecurso::firstOrCreate(['nombre' => $validatedData['tipo_recurso']]);
        $area = \App\Area::firstOrCreate(['nombre' => $validatedData['area']]);
        $especialidad = \App\Especialidad::firstOrCreate(['nombre' => $validatedData['especialidad']]);
        $tipoEquipo = \App\TipoEquipo::firstOrCreate(['nombre' => $validatedData['tipo_equipo']]);
        $marca = \App\Marca::firstOrCreate(['nombre' => $validatedData['marca']]);
        $estado = \App\Estado::firstOrCreate(['nombre' => $validatedData['estado']]);
        $ubicacion = \App\Ubicacion::firstOrCreate(['nombre' => $validatedData['ubicacion']]);
        $personal = \App\Personal::firstOrCreate(['nombre' => $validatedData['personal']]);

        // Crear el nuevo registro de inventario
        $inventario = Inventario::create([
            'tipo_recurso_id' => $tipoRecurso->id,
            'area_id' => $area->id,
            'especialidad_id' => $especialidad->id,
            'tipo_equipo_id' => $tipoEquipo->id,
            'marca_id' => $marca->id,
            'modelo' => $validatedData['modelo'],
            'procesador' => $validatedData['procesador'],
            'ram' => $validatedData['ram'],
            'disco_duro' => $validatedData['disco_duro'],
            'serie' => $validatedData['serie'],
            'cod_patrimonial' => $validatedData['cod_patrimonial'],
            'estado_id' => $estado->id,
            'ubicacion_id' => $ubicacion->id,
            'personal_id' => $personal->id,
            'observaciones' => $validatedData['observaciones'],
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
