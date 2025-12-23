<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carpeta;
use App\Models\Carpetas;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Archivo;
use Illuminate\Validation\ValidationException;

class CarpetasController extends Controller
{
    // Función de depuración para registrar los datos del formulario
    private function debugRequest(Request $request)
    {
        Log::debug('DEBUG - Datos recibidos en formulario:', $request->all());
    }

    // Crear una nueva carpeta (principal o subcarpeta)
    public function store(Request $request)
    {
        // Llamada temporal para depurar los inputs
        $this->debugRequest($request);

        Log::info("📌 Recibida solicitud para crear carpeta", $request->all());

        try {
            // Validar los datos enviados
            $request->validate([
                'nombre_carpeta' => 'required|string|max:255',
                'seccion'       => 'nullable|string',
                'subseccion'    => 'nullable|string',
                'parent_id'     => 'nullable|exists:carpetas,id',
                'proceso_id'    => 'nullable|exists:procesos,id_proceso',
            ]);

            // Determinar la ruta y otros datos
            if ($request->parent_id) {
                // Si es una subcarpeta, hereda la sección y subsección del padre
                $parent = Carpetas::find($request->parent_id);
                if (!$parent) {
                    Log::error("❌ No se encontró la carpeta padre con ID: " . $request->parent_id);
                    return back()->with('error', 'La carpeta principal no existe.');
                }
                $seccion = $parent->seccion;
                $subseccion = $parent->subseccion;

                // Buscar el proceso usando la columna correcta en la tabla procesos
                $procesoObj = \App\Models\Proceso::where('id_proceso', $request->proceso_id)->first();
                $proceso_nombre = $procesoObj ? $procesoObj->nombre_proceso : "";
                $proceso_id = $request->proceso_id;

                // La ruta se forma anexando el nombre de la subcarpeta a la ruta del padre
                $ruta = "{$parent->ruta}/{$request->nombre_carpeta}";
            } else {
                // Si es una carpeta principal, se requiere la sección
                if (!$request->seccion) {
                    Log::error("❌ Error: No se proporcionó una sección.");
                    return back()->with('error', 'Debe seleccionar una sección.');
                }
                $seccion = $request->seccion;
                $subseccion = $request->subseccion;

                // Buscar el proceso usando la columna correcta
                $procesoObj = \App\Models\Proceso::where('id_proceso', $request->proceso_id)->first();
                $proceso_nombre = $procesoObj ? $procesoObj->nombre_proceso : "";
                $proceso_id = $request->proceso_id;

                // Se forma la ruta agregando el nombre del proceso si se ha seleccionado
                if ($proceso_nombre) {
                    $ruta = "archivos/{$seccion}/{$subseccion}/{$proceso_nombre}-{$request->nombre_carpeta}";
                } else {
                    $ruta = "archivos/{$seccion}/{$subseccion}/{$request->nombre_carpeta}";
                }
            }

            Log::info("📂 Ruta determinada: " . $ruta);

            // Validar si la carpeta ya existe en la base de datos
            $carpetaExistente = Carpetas::where('nombre_carpeta', $request->nombre_carpeta)->first();

            if ($carpetaExistente) {
                Log::warning("⚠️ La carpeta ya existe en la base de datos: " . $request->nombre_carpeta);
                return back()->with('error', 'Ya existe una carpeta con el mismo nombre en otra ubicación.');
            }

            // Crear carpeta física en el sistema si no existe
            if (!Storage::disk('private')->exists($ruta)) {
                Storage::disk('private')->makeDirectory($ruta);
                Log::info("✅ Carpeta creada en Storage en: " . $ruta);
            } else {
                Log::warning("⚠️ La carpeta ya existe en Storage en: " . $ruta);
            }

            // Crear la carpeta en la base de datos
            $carpeta = new Carpetas();
            $carpeta->nombre_carpeta = $request->nombre_carpeta;
            $carpeta->seccion = $seccion;
            $carpeta->subseccion = $subseccion;
            $carpeta->ruta = $ruta;
            $carpeta->parent_id = $request->parent_id ?? null;
            $carpeta->proceso_id = $proceso_id;

            Log::info("🛠 Datos de la carpeta antes de guardar", $carpeta->toArray());

            $carpeta->save();

            Log::info("✅ Carpeta registrada en la base de datos con ID: " . $carpeta->id);

            return back()->with('success', 'Carpeta creada correctamente.');
        } catch (ValidationException $ve) {
            Log::error("❌ Error de validación: " . json_encode($ve->errors()));
            throw $ve;
        } catch (\Exception $e) {
            Log::error("❌ Error en store(): " . $e->getMessage());
            report($e);
            return back()->with('error', 'Error al crear la carpeta.');
        }
    }

    // Elimina una carpeta junto con sus archivos
    public function destroy($id)
    {
        $carpeta = Carpetas::findOrFail($id);

        // Eliminar archivos físicos y sus registros
        $archivos = Archivo::where('carpeta_id', $id)->get();
        foreach ($archivos as $archivo) {
            if (Storage::disk('private')->exists($archivo->ruta_archivo)) {
                Storage::disk('private')->delete($archivo->ruta_archivo);
            }
            $archivo->delete();
        }

        // Eliminar carpeta física (solo si existe)
        $rutaCarpeta = "archivos/{$carpeta->seccion}/{$carpeta->subseccion}/{$carpeta->nombre_carpeta}";
        if (Storage::disk('private')->exists($rutaCarpeta)) {
            Storage::disk('private')->deleteDirectory($rutaCarpeta);
        }

        // Eliminar carpeta en la base de datos
        $carpeta->delete();

        return redirect()->route('archivos.index')->with('success', 'Carpeta eliminada correctamente.');
    }

    // Retorna las carpetas principales de una subsección específica
    public function getBySubseccion(Request $request)
    {
        $subseccion = $request->query('subseccion');

        $carpetas = Carpetas::where('subseccion', $subseccion)
            ->whereNull('parent_id')
            ->get();

        return response()->json($carpetas);
    }

    // Devuelve las subcarpetas de una carpeta dada
    public function getSubcarpetas($carpeta_id)
    {
        $subcarpetas = Carpetas::where('parent_id', $carpeta_id)->get();

        return response()->json($subcarpetas);
    }
}
