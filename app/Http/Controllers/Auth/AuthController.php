<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

/**
 * Clase AuthController
 * 
 * Esta clase maneja la autenticación de usuarios, incluyendo el registro y el inicio de sesión.
 */
class AuthController extends Controller
{
    /**
     * Registra un nuevo usuario.
     *
     * @param Request $request La solicitud HTTP con los datos del usuario.
     * @return \Illuminate\Http\Response Respuesta con los datos del usuario y el token API.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',
            'role' => 'required|in:admin,user'  // Validamos que el rol sea 'admin' o 'user'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'api_token' => Str::random(60),
            'role' => $request->role  // Asignamos el rol proporcionado en la solicitud
        ]);

        return response(['user' => $user, 'token' => $user->api_token, 'role' => $user->role]);
    }

    /**
     * Inicia sesión para un usuario existente.
     *
     * @param Request $request La solicitud HTTP con las credenciales del usuario.
     * @return \Illuminate\Http\Response Respuesta con los datos del usuario y el token API, o un mensaje de error.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = Str::random(60);
            $user->api_token = $token;
            $user->save();

            return response(['user' => $user, 'token' => $token]);
        }

        return response(['message' => 'Credenciales inválidas'], 401);
    }
}