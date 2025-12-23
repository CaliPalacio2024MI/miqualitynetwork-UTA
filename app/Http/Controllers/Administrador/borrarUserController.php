<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Privilegios;
use Illuminate\Support\Facades\Log;

//ESTE CONTROLADOR SIRVE DE FORMA LOGICA PARA BORRAR USER SELECCIONADOS
class borrarUserController extends Controller
{
    public function borrarAnfitrion(Request $request)
    {
        try {
            // Se valida que venga un ID válido que exista en la tabla users
            $validated = $request->validate([
                'id' => 'required|integer|exists:users,id',
            ]);

            // Se busca al usuario con ese ID
            $usuario = User::findOrFail($validated['id']);

            // Primero se eliminan los privilegios asociados al usuario
            $borrarPrivi = Privilegios::where('user_id', $usuario->id)->delete();

            // Si los privilegios se eliminaron correctamente
            if ($borrarPrivi !== false) {
                // Ahora sí, se elimina el usuario
                $deleted = $usuario->delete();

                // Si todo sale bien, se registra en el log y se muestra mensaje de éxito
                if ($deleted) {
                    Log::info("Usuario eliminado con éxito. ID: {$usuario->id}");
                    return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
                } else {
                    // Si no se pudo eliminar el usuario, se muestra error
                    return redirect()->back()->withErrors('No se pudo eliminar el usuario.');
                }
            } else {
                // Si no se pudieron eliminar los privilegios, también se muestra error
                return redirect()->back()->withErrors('No se pudieron eliminar los privilegios del usuario.');
            }

        } catch (\Exception $e) {
            // Si ocurre algún error inesperado, se registra en el log y se muestra mensaje genérico
            Log::error('Error al eliminar el usuario: ' . $e->getMessage());
            return redirect()->back()->withErrors('Error al eliminar el usuario. Inténtalo de nuevo.');
        }
    }
}
