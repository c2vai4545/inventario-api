<?php

namespace App\Http\Controllers;

use App\TipoRecurso;
use Illuminate\Http\Request;

class TipoRecursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposRecurso = TipoRecurso::all();
        return response()->json($tiposRecurso);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoRecurso = TipoRecurso::create($request->all());
        return response()->json($tipoRecurso, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoRecurso = TipoRecurso::findOrFail($id);
        return response()->json($tipoRecurso);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipoRecurso = TipoRecurso::findOrFail($id);
        $tipoRecurso->update($request->all());
        return response()->json($tipoRecurso);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoRecurso = TipoRecurso::findOrFail($id);
        $tipoRecurso->delete();
        return response()->json(null, 204);
    }
}
