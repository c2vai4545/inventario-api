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

Route::post('/register', 'Auth\AuthController@register');
Route::post('/login', 'Auth\AuthController@login');

Route::group(['middleware' => ['auth:api', 'role:admin']], function () {
    // Rutas solo para administradores
    Route::get('/admin-only', function () {
        return response()->json(['mensaje' => 'Eres un administrador']);
    });
});

Route::group(['middleware' => ['auth:api', 'role:user']], function () {
    // Ruta para probar el rol de usuario
    Route::get('/user-only', function () {
        return response()->json(['mensaje' => 'Eres un usuario autenticado']);
    });
    // Rutas solo para usuarios
});
