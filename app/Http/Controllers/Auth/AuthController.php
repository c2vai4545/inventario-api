<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = Hash::make($request->password);
        $validatedData['api_token'] = Str::random(60);

        $user = User::create($validatedData);

        return response(['user' => $user, 'token' => $user->api_token]);
    }

    /**
     * Inicia sesión para un usuario existente.
     *
     * @param Request $request La solicitud HTTP con las credenciales del usuario.
     * @return \Illuminate\Http\Response Respuesta con los datos del usuario y el token API, o un mensaje de error.
     */
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $user = User::where('email', $validatedData['email'])->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = Str::random(60);
            $user->api_token = $token;
            $user->save();

            return response(['user' => $user, 'token' => $token]);
        }

        return response(['message' => 'Credenciales inválidas'], 401);
    }
}