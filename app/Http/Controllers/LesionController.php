<?php

namespace App\Http\Controllers;

use App\Models\Lesion;
use Illuminate\Http\Request;

class LesionController extends Controller
{
    /**
     * 1) API JSON para el <select> en JS
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json(Lesion::all());
        }

        return redirect()->route('admin.lesiones.index');
    }


    /**
     * 2) Listado en Panel de Administración
     */
    public function listado()
    {
        $lesiones = Lesion::all();
        return view('administracion.lesiones', compact('lesiones'));
    }

    /**
     * 3) Formulario de creación clásico
     */
    public function create()
    {
        return view('lesiones.create');
    }

    /**
     * 4) Guarda la nueva lesión
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Lesion::create($request->only('nombre'));

        return redirect()
            ->route('admin.lesiones.index')
            ->with('success', 'Lesión creada correctamente');
    }

    /**
     * 5) Muestra detalle de una lesión
     */
    public function show(Lesion $lesion)
    {
        return view('lesiones.show', compact('lesion'));
    }

    /**
     * 6) Formulario de edición
     */
    public function edit(Lesion $lesion)
    {
        return view('lesiones.edit', compact('lesion'));
    }

    /**
     * 7) Actualiza la lesión
     */
    public function update(Request $request, Lesion $lesion)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $lesion->update($request->only('nombre'));

        return redirect()
            ->route('admin.lesiones.index')
            ->with('success', 'Lesión actualizada correctamente');
    }

    /**
     * 8) Elimina la lesión
     */
    public function destroy(Lesion $lesion)
    {
        $lesion->delete();

        return redirect()
            ->route('admin.lesiones.index')
            ->with('success', 'Lesión eliminada correctamente');
    }
}
