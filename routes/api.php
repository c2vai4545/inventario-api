<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'Auth\AuthController@login');

Route::group(['middleware' => ['auth:api', 'role:admin']], function () {
    // Rutas para probar el rol de administrador
    Route::get('/admin-only', function () {
        return response()->json(['mensaje' => 'Eres un administrador']);
    });
    // Rutas solo para administradores
    Route::post('/register', 'Auth\AuthController@register');
    Route::delete('/inventario/{id}', 'InventarioController@destroy');
});

Route::group(['middleware' => ['auth:api', 'role:user']], function () {
    // Ruta para probar el rol de usuario
    Route::get('/user-only', function () {
        return response()->json(['mensaje' => 'Eres un usuario autenticado']);
    });
    // Rutas solo para usuarios
    Route::get('/inventario', 'InventarioController@index');
    Route::post('/inventario', 'InventarioController@store');
    Route::get('/inventario/{id}', 'InventarioController@show');
    Route::put('/inventario/{id}', 'InventarioController@update');
});
