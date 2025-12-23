<?php

namespace App\Modules\Control_energeticos\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Control_energeticos\Models\Controlenergeticos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControlenergeticosController extends Controller
{
    public function home()
    {
        return view('modules.controlenergeticos.home');
    }

    public static function getEnergeticosPorModulo($modulo)
    {
        return Controlenergeticos::where('modulo', $modulo)->get();
    }

    public function adminEnergeticos()
    {
        $user = Auth::user();

        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return view('layouts.dashboard');
        }

        return view('modules.controlenergeticos.administracion.admin_energeticos');
    }

    public function energeticos()
    {
        $user = Auth::user();

        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return view('layouts.dashboard');
        }

        $energeticos = Controlenergeticos::all();

        return view('modules.controlenergeticos.administracion.energeticos', [
            'energeticos' => $energeticos
        ]);
    }

    // CREAR nuevo energético
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return redirect()->route('layouts.dashboard');
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad' => 'required|string|max:50',
            'modulo' => 'required|in:agua,electricidad,aire',
            'color' => 'required|string|max:7'
        ]);

        Controlenergeticos::create($validated);

        return redirect()->route('control.energeticos.index')
                         ->with('success', 'Energético creado correctamente');
    }

    // ACTUALIZAR energético existente
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return redirect()->route('layouts.dashboard');
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad' => 'required|string|max:50',
            'modulo' => 'required|in:agua,electricidad,aire',
            'color' => 'required|string|max:7'
        ]);

        $energetico = Controlenergeticos::findOrFail($id);
        $energetico->update($validated);

        return redirect()->route('control.energeticos.index')
                         ->with('success', 'Energético actualizado correctamente');
    }

    // ELIMINAR energético
    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            return redirect()->route('layouts.dashboard');
        }

        $energetico = Controlenergeticos::findOrFail($id);
        $energetico->delete();

        return redirect()->route('control.energeticos.index')
                         ->with('success', 'Energético eliminado correctamente');
    }
}
