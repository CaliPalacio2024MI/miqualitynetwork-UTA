<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Responsable;

class ResponsableController extends Controller
{
    // Muestra la vista principal con todos los responsables
    public function index()
    {
        $responsables = Responsable::all();
        return view('administracion.responsable', compact('responsables'));
    }

    // Guarda un nuevo responsable
    public function crear(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Responsable::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->back()->with('success', 'Responsable registrado exitosamente');
    }

    // Actualiza un responsable existente
    public function actualizar(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:responsables,id',
            'nombre' => 'required|string|max:255',
        ]);

        $responsable = Responsable::find($request->id);
        $responsable->nombre = $request->nombre;
        $responsable->save();

        return redirect()->back()->with('success', 'Responsable actualizado exitosamente');
    }

    // Elimina un responsable
    public function eliminar(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:responsables,id',
        ]);

        Responsable::destroy($request->id);

        return redirect()->back()->with('success', 'Responsable eliminado correctamente');
    }
}
