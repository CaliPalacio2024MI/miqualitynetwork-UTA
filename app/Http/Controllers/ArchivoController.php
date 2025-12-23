<?php

namespace App\Http\Controllers;

use App\Models\Proceso;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Archivo;
use App\Models\Carpetas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ArchivoController extends Controller
{
    // Muestra la vista principal del gestor de archivos
    public function index()
    {
        $user = Auth::user();

        // Verifica si el usuario tiene permisos de administración
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            $mensaje = 1;
            return view('layouts.dashboard', compact('mensaje'));
        }

        // Obtiene todos los procesos y carpetas principales (sin parent_id)
        $procesos = Proceso::all();
        $carpetas = Carpetas::whereNull('parent_id')->get();
        $archivos = Archivo::all(); // Archivos existentes

        return view('archivos.index', compact('carpetas', 'procesos', 'archivos'));
    }

    // Guarda los archivos subidos por el usuario
    public function store(Request $request)
    {

        // Registrar los datos recibidos
        \Log::info('Datos recibidos:', $request->all());

        // Validar y procesar los datos
        $validatedData = $request->validate([
            'medio_soporte' => 'required|string',
            'disposicion_final' => 'required|string',

            // Otros campos...
        ]);

        // Validar los datos del formulario
        $request->validate([
            'tiempo_numero' => 'required|integer',
            'tiempo_unidad' => 'required|string',
            'archivos' => 'required|array',
            'archivos.*' => 'file|max:2048',
            'fecha_emision*' => 'required|date',
            'seccion' => 'required|string',
            'subseccion' => 'nullable|string',
            'carpeta_id' => 'required|integer|exists:carpetas,id',
            'subcarpeta_id' => 'nullable|integer|exists:carpetas,id',
            'tipo_proceso' => 'required|string',
            'proceso_id' => 'nullable|integer',
            'tipo_documento' => 'required|string',
            'identificacion' => 'required|string',
            'medio_soporte' => 'required|string',
            'responsable_almacenamiento' => 'required|string',
            'disposicion_final' => 'required|string',
            'edicion' => 'required|string',
            'estatus_actual' => 'nullable|string',
            'tiempo_conservacion' => 'nullable|string',
            'cambio_realizado' => 'nullable|string',
            'razon_eliminacion' => 'nullable|string',
            'fecha_eliminacion' => 'nullable|string',
            'responsable_eliminacion' => 'nullable|string',
            'responsable_cambio' => 'nullable|string',
            'nueva_edicion' => 'nullable|string',
            'nueva_fecha_emision' => 'nullable|date',

        ]);

        $numero = $request->input('tiempo_numero');
        $unidad = $request->input('tiempo_unidad');

        if ($numero > 1) {
            if ($unidad === 'día') {
                $unidad = 'días';
            } elseif ($unidad === 'mes') {
                $unidad = 'meses';
            } elseif ($unidad === 'año') {
                $unidad = 'años';
            }
        }
        // Combinar los valores de número y unidad
        $tiempoConservacion = $numero . ' ' . $unidad;

        // Determinar el valor de estatus_actual
        $estatusActual = $request->has('estatus_actual') ? 'Vigente' : 'Obsoleto';

        // Determina la carpeta donde se almacenará el archivo
        $carpetaId = $request->subcarpeta_id ?? $request->carpeta_id;
        $carpeta = Carpetas::findOrFail($carpetaId);
        $ruta = "{$carpeta->ruta}/";

        // Forzar el valor de disposición final basado en medio de soporte
        $disposicionFinal = match ($validatedData['medio_soporte']) {
            'Carpeta Electrónica' => 'Eliminación/Supresión',
            'Carpeta Física' => 'Destrucción',
            default => null,
        };

        if (!$disposicionFinal) {
            return back()->withErrors(['medio_soporte' => 'El medio de soporte seleccionado no es válido.']);
        }
        // Buscar el proceso por el campo tipo_proceso recibido del formulario
        $proceso = Proceso::where('nombre_proceso', $request->tipo_proceso)->first();

        if (!$proceso) {
            return back()->withErrors(['tipo_proceso' => 'El proceso seleccionado no existe.']);
        }

        // Guarda los archivos subidos
        if ($request->hasFile('archivos')) {
            // dd($request->all());
            foreach ($request->file('archivos') as $archivo) {
                $archivoRuta = $archivo->store($ruta, 'private');

                // Crear un nuevo registro en la base de datos
                Archivo::create([
                    'nombre_archivo' => $archivo->getClientOriginalName(),
                    'ruta_archivo' => $archivoRuta,
                    'tipoarchivo_mime' => $archivo->getClientMimeType(),
                    'tamano' => $archivo->getSize(),
                    'fecha_emision' => $request->fecha_emision,
                    'seccion' => $request->seccion,
                    'subseccion' => $request->subseccion,
                    'carpeta_id' => $carpetaId,
                    'proceso_id' => $proceso->id_proceso,
                    'tipo_proceso' => $request->tipo_proceso,
                    'tipo_documento' => $request->tipo_documento,
                    'identificacion' => $request->identificacion,
                    'medio_soporte' => $validatedData['medio_soporte'],
                    'disposicion_final' => $disposicionFinal,
                    'responsable_almacenamiento' => $request->responsable_almacenamiento,
                    'edicion' => $request->edicion,
                    'estatus_actual' => $estatusActual,
                    'tiempo_conservacion' => $tiempoConservacion,
                    'cambio_realizado' => $request->cambio_realizado,
                    'razon_eliminacion' => $request->razon_eliminacion,
                    'fecha_eliminacion' => $request->fecha_eliminacion,
                    'responsable_eliminacion' => $request->responsable_eliminacion,
                    'responsable_cambio' => $request->responsable_cambio,
                    'nueva_edicion' => $request->nueva_edicion,
                    'nueva_fecha_emision' => $request->nueva_fecha_emision,
                ]);
            }
        }

        return back()->with('success', 'Archivos subidos correctamente.');
    }

    // Permite descargar un archivo si el usuario tiene permisos
    public function download($id)
    {
        $archivo = Archivo::where('id_archivo', $id)->firstOrFail();

        // Verifica permisos de acceso al archivo
        if (!$this->usuarioPuedeVerArchivo($archivo)) {
            abort(403, 'No tienes permiso para descargar este archivo.');
        }

        // Verifica que el archivo exista físicamente
        if (!Storage::disk('private')->exists($archivo->ruta_archivo)) {
            return back()->with('error', 'El archivo no existe.');
        }

        // Retorna la descarga del archivo
        return response()->download(storage_path("app/private/{$archivo->ruta_archivo}"), $archivo->nombre_archivo);
    }

    // Oculta el archivo marcándolo como no visible (sin eliminarlo)
    public function destroy($id)
    {
        $archivo = Archivo::findOrFail($id);
        $archivo->visible = false;
        $archivo->save();

        return back()->with('success', 'Archivo ocultado de la vista.');
    }

    // Visualiza un archivo PDF directamente en el navegador
    public function verPdf($id)
    {
        $archivo = Archivo::where('id_archivo', $id)->firstOrFail();

        if ($archivo->tipoarchivo_mime !== 'application/pdf') {
            return response()->json(['error' => 'Este archivo no es un PDF.'], 403);
        }

        if (!$this->usuarioPuedeVerArchivo($archivo)) {
            abort(403, 'No tienes permiso para visualizar este archivo.');
        }

        $rutaArchivo = storage_path("app/private/{$archivo->ruta_archivo}");

        if (!file_exists($rutaArchivo)) {
            abort(404, 'El archivo no existe.');
        }

        return response()->file($rutaArchivo, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $archivo->nombre_archivo . '"'
        ]);
    }

    // Muestra una imagen almacenada en el sistema
    public function imagen($nombre)
    {
        $path = storage_path('app/public/' . $nombre);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    // Marca un archivo como oculto
    public function ocultar(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'razon_eliminacion' => 'required|string',
            'fecha_eliminacion' => 'required|date',
            'responsable_eliminacion' => 'required|string',
        ]);

        // Buscar el archivo y actualizar los datos
        $archivo = Archivo::findOrFail($id);
        $archivo->update([
            'visible' => 0, // Ocultar el archivo
            'razon_eliminacion' => $request->razon_eliminacion,
            'fecha_eliminacion' => $request->fecha_eliminacion,
            'responsable_eliminacion' => $request->responsable_eliminacion,
        ]);

        return redirect()->back()->with('success', 'El archivo ha sido ocultado correctamente.');
    }

    // Restaura un archivo previamente oculto
    public function restaurar($id)
    {
        $archivo = Archivo::findOrFail($id);
        $archivo->visible = true;
        $archivo->razon_eliminacion = null;
        $archivo->fecha_eliminacion = null;
        $archivo->responsable_eliminacion = null;
        $archivo->save();

        return back()->with('success', 'Archivo restaurado correctamente.');
    }

    // Verifica si el usuario actual puede ver un archivo específico
    protected function usuarioPuedeVerArchivo(Archivo $archivo): bool
    {
        $usuario = Auth::user();

        // Administradores tienen acceso completo
        if ($usuario->privilegios && $usuario->privilegios->acceso_administrarusuarios) {
            return true;
        }

        // Verificar si el usuario tiene acceso a la carpeta del archivo
        if ($usuario->carpetasAccesibles->contains($archivo->carpeta_id)) {
            return true;
        }

        return false;
    }

    // Lista los archivos eliminados
    public function listaEliminados()
    {
        // Obtener los archivos con visible = 0
        $archivos = Archivo::where('visible', 0)->get();

        // Pasar los datos a la vista
        return view('calidad.lmeliminada', compact('archivos'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $id = $request->archivo_id;
        // Obtener el archivo original usando el campo 'id_archivo'
        $archivoOriginal = Archivo::where('id_archivo', $id)->firstOrFail();

        $validatedData = $request->validate([
            'cambio_realizado' => 'required|string',
            'nueva_edicion' => 'required|string',
            'nueva_fecha_emision' => 'required|date',
            'responsable_cambio' => 'required|string',
            'nuevo_archivo' => 'nullable|file|max:2048',
        ]);

        $nuevoArchivo = $archivoOriginal->replicate();

        if ($request->hasFile('nuevo_archivo')) {
            $carpeta = Carpetas::findOrFail($archivoOriginal->carpeta_id);
            $ruta = "{$carpeta->ruta}/";
            $archivoRuta = $request->file('nuevo_archivo')->store($ruta, 'private');

            $nuevoArchivo->nombre_archivo = $request->file('nuevo_archivo')->getClientOriginalName();
            $nuevoArchivo->ruta_archivo = $archivoRuta;
            $nuevoArchivo->tipoarchivo_mime = $request->file('nuevo_archivo')->getClientMimeType();
            $nuevoArchivo->tamano = $request->file('nuevo_archivo')->getSize();
        }

        $nuevoArchivo->edicion = $validatedData['nueva_edicion'];
        $nuevoArchivo->fecha_emision = $validatedData['nueva_fecha_emision'];
        $nuevoArchivo->responsable_almacenamiento = $validatedData['responsable_cambio'];
        $nuevoArchivo->estatus_actual = 'Vigente';
        $nuevoArchivo->save();

        $archivoOriginal->update([
            'estatus_actual' => 'Obsoleto',
            'cambio_realizado' => $validatedData['cambio_realizado'],
            'nueva_edicion' => $validatedData['nueva_edicion'],
            'nueva_fecha_emision' => $validatedData['nueva_fecha_emision'],
            'responsable_cambio' => $validatedData['responsable_cambio'],
            'se_ha_hecho_cambio' => 1,
        ]);

        return redirect()->back()->with('success', 'Archivo actualizado correctamente.');
    }

    public function show($id)
    {
        $archivo = Archivo::findOrFail($id); // Busca el archivo por ID
        return response()->json($archivo); // Devuelve los datos en formato JSON
    }



    public function firmar(Request $request, $id)
    {
        $archivo = \App\Models\Archivo::findOrFail($id);
        $responsable = $request->input('responsable');

        // Obtener el proceso relacionado
        $proceso = \App\Models\Proceso::find($archivo->proceso_id);

        if (!$proceso) {
            return response()->json(['success' => false, 'message' => 'Proceso no encontrado'], 400);
        }

        $responsables = [
            $proceso->responsable1,
            $proceso->responsable2,
            $proceso->responsable3
        ];

        $columnaFirma = null;
        $columnaFecha = null;
        foreach ($responsables as $index => $resp) {
            if (trim(strtolower($resp)) == trim(strtolower($responsable))) {
                $columnaFirma = 'firma' . ($index + 1);
                $columnaFecha = 'fechafirma' . ($index + 1);
                break;
            }
        }

        if ($columnaFirma && $columnaFecha) {
            // Verifica si ya firmó
            if ($archivo->$columnaFirma == 1) {
                return response()->json(['success' => false, 'message' => 'Este responsable ya ha firmado.'], 400);
            }
            $archivo->$columnaFirma = 1;
            $archivo->$columnaFecha = now();
            $archivo->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Responsable no válido'], 400);
        }
    }


    public function estadoFirmas($id)
    {
        $archivo = \App\Models\Archivo::findOrFail($id);
        $proceso = \App\Models\Proceso::find($archivo->proceso_id);

        if (!$proceso) {
            return response()->json(['success' => false, 'message' => 'Proceso no encontrado'], 400);
        }

        $responsables = [
            $proceso->responsable1,
            $proceso->responsable2,
            $proceso->responsable3
        ];

        \Log::info('Responsables del proceso:', $responsables);
        $firmas = [];
        $total = 0;
        foreach ($responsables as $i => $nombre) {
            if ($nombre && trim($nombre) !== '') {
                $total++;
                $colFirma = 'firma' . ($i + 1);
                $colFecha = 'fechafirma' . ($i + 1);

                $fechaFirma = null;
                if ($archivo->$colFecha) {
                    try {
                        $fechaFirma = Carbon::parse($archivo->$colFecha)->format('Y-m-d H:i');
                    } catch (\Exception $e) {
                        $fechaFirma = $archivo->$colFecha; // fallback por si acaso
                    }
                }

                $firmas[] = [
                    'nombre' => $nombre,
                    'firmado' => $archivo->$colFirma == 1,
                    'fecha' => $fechaFirma,
                ];
            }
        }


        return response()->json([
            'success' => true,
            'firmas' => $firmas,
            'total' => $total,
            'firmados' => collect($firmas)->where('firmado', true)->count(),
        ]);

    }
    public function responsablesPorArchivo($id)
    {
        $archivo = \App\Models\Archivo::findOrFail($id);
        $proceso = \App\Models\Proceso::find($archivo->proceso_id);

        if (!$proceso) {
            return response()->json([]);
        }

        $responsables = [];
        if ($proceso->responsable1)
            $responsables[] = $proceso->responsable1;
        if ($proceso->responsable2)
            $responsables[] = $proceso->responsable2;
        if ($proceso->responsable3)
            $responsables[] = $proceso->responsable3;

        return response()->json($responsables);
    }
    public function proceso()
    {
        return $this->belongsTo(\App\Models\Proceso::class, 'proceso_id');
    }
}
