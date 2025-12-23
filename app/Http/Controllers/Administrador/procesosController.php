<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proceso;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class procesosController extends Controller
{
    public function crearProceso(Request $request)
    {
        try {
            Log::info('Datos recibidos para crear proceso:', $request->all());

            // Validar solo nombre y tipo
            $validated = $request->validate([
                'nombre' => 'required|string|max:255|unique:procesos,nombre_proceso',
                'tipo'   => 'required|in:apoyo,operativo',
            ]);

            // Crear nuevo proceso sin responsables
            $proceso = Proceso::create([
                'nombre_proceso' => $validated['nombre'],
                'tipo'           => $validated['tipo'],
            ]);

            Log::info("Proceso registrado con éxito. ID: {$proceso->id_proceso}");

            return redirect()->back()->with('success', '');
        } catch (\Exception $e) {
            Log::error('Error al registrar el proceso: ' . $e->getMessage());
            return redirect()->back()->withErrors('Error al registrar el proceso. Inténtalo de nuevo.');
        }
    }

    public function borrarProceso(Request $request)
    {
        try {
            $proceso = Proceso::findOrFail($request->id);
            $proceso->delete();

            return redirect()->back()->with('terminado', '');
        } catch (\Exception $e) {
            Log::error('Error al eliminar el proceso: ' . $e->getMessage());
            return redirect()->back()->withErrors('Error al eliminar el proceso.');
        }
    }

    public function modificar_proceso(Request $request)
    {
        try {
            Log::info('Datos recibidos para modificar propiedad:', $request->all());

            $validated = $request->validate([
                'id_procesos' => 'required|integer|exists:procesos,id_proceso',
                'nombre_proceso' => 'required|string|max:255',
            ]);

            $proceso = Proceso::findOrFail($validated['id_procesos']);
            $proceso->nombre_proceso = $validated['nombre_proceso'];
            $proceso->save();

            return redirect()->back()->with('terminado', '');
        } catch (\Exception $e) {
            Log::error('Error al actualizar propiedad: ' . $e->getMessage());
            return redirect()->back()->withErrors(['Error al actualizar propiedad.']);
        }
    }

    public function mostrarProcesos()
    {
        $user = Auth::user();

        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            $mensaje = 1;
            return view('layouts.dashboard', compact('mensaje'));
        } else {
            $datos = Proceso::all();
            return view('administracion.procesos', compact('datos'));
        }
    }

    public function obtenerProcesos()
    {
        return response()->json(Proceso::all());
    }
}
