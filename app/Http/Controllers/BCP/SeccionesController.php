<?php

namespace App\Http\Controllers\BCP;

use Illuminate\Http\Request;
use App\Models\BCP\Catalogo;
use App\Http\Controllers\Controller;

class SeccionesController extends Controller
{
    public function index()
    {
        $secciones = Catalogo::whereNotNull('Secciones')
            ->select('Secciones')
            ->distinct()
            ->orderBy('Secciones', 'asc')
            ->get();

        return view('seguridaddelainformacion.bcp.secciones', compact('secciones'));
    }

    public function filtrarHabitaciones(Request $request)
    {
        $edificio = $request->input('Edificio');
        $piso = $request->input('Piso');

        $habitaciones = Catalogo::whereNull('Secciones')
            ->where('Edificio', $edificio)
            ->where('Piso', $piso)
            ->get(['N_Hab']);

        return response()->json($habitaciones);
    }

    public function store(Request $request)
    {
        $nombreSeccion = $request->input('Secciones');
        $habitaciones = json_decode($request->input('habitacionesSeleccionadas'), true);

        if (!is_array($habitaciones) || count($habitaciones) === 0) {
            return back()->with('error', 'No se seleccionaron habitaciones.');
        }

        Catalogo::whereIn('N_Hab', $habitaciones)
            ->update(['Secciones' => $nombreSeccion]);

        return redirect()->back()->with('success', 'Sección asignada correctamente.');
    }

    public function eliminar($seccion)
    {
        Catalogo::where('Secciones', $seccion)->update(['Secciones' => null]);

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $seccionOriginal)
    {
        $nuevoNombre = $request->input('Secciones');
        $habitaciones = json_decode($request->input('habitacionesSeleccionadas'), true);
        $eliminadas = json_decode($request->input('habitacionesEliminadas'), true);

        if (!is_array($habitaciones)) $habitaciones = [];
        if (!is_array($eliminadas)) $eliminadas = [];

        // Verificar si el nuevo nombre ya existe (cuando cambia)
        if ($nuevoNombre !== $seccionOriginal) {
            $existe = Catalogo::where('Secciones', $nuevoNombre)->exists();
            if ($existe) {
                return back()->with('error', 'Ya existe una sección con ese nombre.');
            }

            // Cambiar el nombre a las habitaciones que tenían el nombre anterior
            Catalogo::where('Secciones', $seccionOriginal)
                ->update(['Secciones' => $nuevoNombre]);
        }

        // Quitar habitaciones que ya no pertenecen a esta sección
        if (count($eliminadas) > 0) {
            Catalogo::whereIn('N_Hab', $eliminadas)
                ->update(['Secciones' => null]);
        }

        // Asignar habitaciones nuevas o mantenidas a esta sección
        if (count($habitaciones) > 0) {
            Catalogo::whereIn('N_Hab', $habitaciones)
                ->update(['Secciones' => $nuevoNombre]);
        }

        return redirect()->back()->with('success', 'Sección actualizada correctamente.');
    }
}
