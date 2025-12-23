<?php

namespace App\Http\Controllers;

use App\Models\Accidente;
use Illuminate\Http\Request;

class AccidenteController extends Controller
{
    /**
     * 1) Si la petición es JSON (AJAX), devuelve JSON.
     *    Si es web normal, redirige al panel.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json(Accidente::all());
        }

        return redirect()->route('admin.accidentes.index');
    }

    /**
     * 2) Panel de administración (vista Blade)
     */
    public function listado()
    {
        $accidentes = Accidente::all();
        return view('administracion.accidentes', compact('accidentes'));
    }

    /**
     * 3) Formulario para crear nuevo accidente
     */
    public function create()
    {
        return view('accidentes.create');
    }

    /**
     * 4) Guarda un nuevo accidente en la base de datos
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Accidente::create($request->only('nombre'));

        return redirect()
            ->route('admin.accidentes.index')
            ->with('success', 'Accidente creado correctamente');
    }

    /**
     * 5) Muestra detalle de un accidente
     */
    public function show(Accidente $accidente)
    {
        return view('accidentes.show', compact('accidente'));
    }

    /**
     * 6) Formulario de edición de accidente
     */
    public function edit(Accidente $accidente)
    {
        return view('accidentes.edit', compact('accidente'));
    }

    /**
     * 7) Actualiza un accidente existente
     */
    public function update(Request $request, Accidente $accidente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $accidente->update($request->only('nombre'));

        return redirect()
            ->route('admin.accidentes.index')
            ->with('success', 'Accidente actualizado correctamente');
    }

    /**
     * 8) Elimina un accidente
     */
    public function destroy(Accidente $accidente)
    {
        $accidente->delete();

        return redirect()
            ->route('admin.accidentes.index')
            ->with('success', 'Accidente eliminado');
    }
}
