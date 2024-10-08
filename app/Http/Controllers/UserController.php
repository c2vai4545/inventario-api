<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

/**
 * Controlador para manejar operaciones relacionadas con usuarios.
 */
class UserController extends Controller
{
    /**
     * Actualiza los datos específicos de un usuario.
     *
     * @param Request $request La solicitud HTTP con los datos del usuario a actualizar.
     * @param int $id El ID del usuario a actualizar.
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con mensaje de éxito y datos del usuario actualizados.
     */
    public function updateUser(Request $request, $id)
    {
        // Busca el usuario por ID o lanza una excepción si no se encuentra
        $user = User::findOrFail($id);
        
        // Valida los datos proporcionados
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $id,
            'role' => 'sometimes|string|in:admin,editor,user',
            // Agrega aquí más campos según sea necesario
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Actualiza solo los campos proporcionados en la solicitud
        $fieldsToUpdate = $request->only(['name', 'email', 'role']);
        foreach ($fieldsToUpdate as $key => $value) {
            if (!is_null($value)) {
                $user->$key = $value;
            }
        }
        $user->save();

        // Retorna una respuesta JSON con un mensaje de éxito y los datos del usuario actualizados
        return response()->json(['mensaje' => 'Datos de usuario actualizados con éxito', 'usuario' => $user]);
    }


    /**
     * Cambia el estado del usuario con el ID especificado.
     *
     * @param int $id El ID del usuario a cambiar de estado.
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con mensaje de éxito y datos del usuario con nuevo estado.
     */
    public function cambiarEstadoUsuario($id)
    {
        $user = User::findOrFail($id);
        $user->active = !$user->active; // Cambia el estado actual al opuesto
        $user->save();

        $estado = $user->active ? 'activado' : 'inactivado';
        return response()->json(['mensaje' => "Usuario {$estado} con éxito", 'usuario' => $user]);
    }
}
