<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InventarioController;

/*
|--------------------------------------------------------------------------
| Rutas de API
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas de API para tu aplicación.
| Estas rutas son cargadas por el RouteServiceProvider dentro de un grupo
| que tiene asignado el middleware "api". ¡Disfruta construyendo tu API!
|
*/

// Ruta para obtener el usuario autenticado
// Retorna los datos del usuario actualmente autenticado
Route::middleware(['auth:api', 'active'])->get('/user', function (Request $request) {
    return $request->user();
});

// Ruta para iniciar sesión (no necesita verificación de usuario activo)
// Maneja el proceso de autenticación del usuario
Route::post('/login', [AuthController::class, 'login']);

// Grupo de rutas para administradores
Route::group(['middleware' => ['auth:api', 'active', 'role:admin']], function () {
    // Ruta de prueba para el rol de administrador
    Route::get('/admin-only', function () {
        return response()->json(['mensaje' => 'Eres un administrador']);
    });
    
    // Rutas CRUD para administradores
    // Registra un nuevo usuario en el sistema
    Route::post('/register', 'Auth\AuthController@register');
    // Actualiza los datos de un usuario específico
    Route::put('/usuarios/{id}', 'UserController@updateUser');
    // Alterna el estado activo/inactivo de un usuario
    Route::put('/usuarios/{id}/cambiar-estado', 'UserController@cambiarEstadoUsuario');
    
    // Elimina un elemento específico del inventario
    Route::delete('/inventario/{id}', 'InventarioController@destroy');
    // Obtiene la lista completa del inventario
    Route::get('/inventario', 'InventarioController@index');
    // Crea un nuevo elemento en el inventario
    Route::post('/inventario', 'InventarioController@store');
    // Obtiene los detalles de un elemento específico del inventario
    Route::get('/inventario/{id}', 'InventarioController@show');
    // Actualiza un elemento específico del inventario
    Route::put('/inventario/{id}', 'InventarioController@update');
});

// Grupo de rutas para usuarios normales
Route::group(['middleware' => ['auth:api', 'active', 'role:user']], function () {
    // Ruta de prueba para el rol de usuario
    Route::get('/user-only', function () {
        return response()->json(['mensaje' => 'Eres un usuario autenticado']);
    });
    
    // Rutas CRUD para usuarios normales (sin acceso a eliminación)
    // Obtiene la lista completa del inventario
    Route::get('/inventario', 'InventarioController@index');
    // Crea un nuevo elemento en el inventario
    Route::post('/inventario', 'InventarioController@store');
    // Obtiene los detalles de un elemento específico del inventario
    Route::get('/inventario/{id}', 'InventarioController@show');
    // Actualiza un elemento específico del inventario
    Route::put('/inventario/{id}', 'InventarioController@update');
});

