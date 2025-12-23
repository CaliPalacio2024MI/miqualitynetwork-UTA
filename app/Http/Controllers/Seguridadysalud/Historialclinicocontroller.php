<?php

namespace App\Http\Controllers\Seguridadysalud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Archivo;
use App\Models\Carpetas;
use App\Models\Accidente;
use App\Models\Lesion;
use App\Models\Causa;
use App\Models\Departamento; // ← impórtalo
use App\Models\Historialclinico;
use App\Models\ParteAfectada;


class Historialclinicocontroller extends Controller
{
    // 1) Vista principal de Historial Clínico (menú y carpetas)
    public function historialclinico()
    
    {
        $user = Auth::user();
        if (! $user->privilegios || ! $user->privilegios->acceso_perservaciondelasalud) {
            return view('layouts.dashboard');
        }

        $carpetas = $user->carpetasAccesibles()
            ->where('subseccion', 'historial_clinico')
            ->whereNull('parent_id')
            ->get();

        return view('seguridadysalud.historialclinico', compact('carpetas'));
    }

    // 2) Nuevo: mostrar el formulario con los datos de Accidentes, Lesiones y Causas
    public function create()
    {
        $user = Auth::user();
        if (! $user->privilegios || ! $user->privilegios->acceso_perservaciondelasalud) {
            return view('layouts.dashboard');
        }

        $accidentes = Accidente::all();
        $lesiones   = Lesion::all(); // ← ESTA ES LA VARIABLE QUE FALTA
        $causas     = Causa::all();
        $departamentos = Departamento::all();

        return view(
            'modules.historialclinico.Formulario.formulario',
            compact('accidentes','lesiones','causas','departamentos')
        );
    }

    // 3) Listar archivos en una carpeta específica
    public function listarArchivos($carpeta_id)
    {
        // ... (tu código actual) ...
    }

    // 4) Ver carpeta y subcarpetas
    public function verCarpeta($carpeta_id)
    {
        // ... (tu código actual) ...
    }

    ////////////////////////////////////////////

    public function store(Request $request)
    {
        // Validación (puedes ajustar según tus campos)
        $request->validate([
            'fecha_reporte'     => 'required|date',
            'numero_caso'       => 'required|string|max:100',
            'nombre_lesionado'  => 'required|string|max:255',
            'partes_afectadas'  => 'nullable|string', // ← JSON de Konva
            // Agrega más validaciones si quieres
        ]);

        // Guardamos el historial clínico principal
        $historial = Historialclinico::create($request->all());

        // Guardamos las partes del cuerpo afectadas
        $partes = json_decode($request->input('partes_afectadas'), true);
        if (is_array($partes)) {
            foreach ($partes as $parte) {
                $historial->partesAfectadas()->create([
                    'parte_cuerpo' => $parte,
                ]);
            }
        }

        // Redirigir o responder
        return redirect()->back()->with('success', 'Historial clínico guardado correctamente.');
    }



}
