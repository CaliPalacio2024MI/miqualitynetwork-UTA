<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Privilegios;
use App\Models\Propiedades;
use Illuminate\Support\Facades\Auth;
// 🔽 AGREGADO
use App\Models\Departamento;
use App\Models\Puestos;


class crearAnfitrionController extends Controller
{
    public function crear()
    {
        $user = Auth::user();

        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            $mensaje = 1;
            return view('layouts.dashboard', compact('mensaje'));
        }

        $usuarios = User::with('privilegios')->get(['id', 'name', 'apellido_paterno', 'rfc', 'departamento', 'propiedad_id']);
        $propiedades = Propiedades::get(['id_propiedad', 'nombre_propiedad']);
        $carpetas = DB::table('carpetas')->get(['id', 'nombre_carpeta', 'ruta']);

        return view('administracion.crearuser', compact('usuarios', 'propiedades', 'carpetas'));
    }

    public function store(Request $request)
    {
        try {
            Log::info('📌 Datos recibidos para crear usuario:', $request->all());

            $request->merge([
                'acceso' => array_map(fn($item) => trim(strtolower($item)), $request->input('acceso', [])),
            ]);

            $accesos = $request->input('acceso', []);
            if (in_array('procesosoperativos', $accesos) || in_array('procesosdeapoyo', $accesos)) {
                $accesos[] = 'documentacionmi';
                $accesos = array_unique($accesos);
            }

            $request->merge(['acceso' => $accesos]);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'apellido_paterno' => 'required|string|max:255',
                'rfc' => 'required|string|max:13|unique:users,rfc',
                'password' => 'required|string|min:8',
                'departamento_id' => 'required|integer|exists:departamentos,id', // ✅ esto sí viene del <select>
                'propiedad_id' => 'nullable|integer|exists:propiedades,id_propiedad',
                'acceso' => 'array',
                'acceso.*' => 'string|in:calidad,ambiental,salud,informacion,alimentaria,contextoorg,liderazgo,planificacion,apoyo,documentacionmi,mireservaciondeeventos,controldocumental,documentaciondelaoperacion,procesosoperativos,procesosdeapoyo,evaldesempeño,revenuereports,balancescorecard,mejora,controlplanesdeaccion,residuos,controlderesiduos,reportederesiduos,energia,controldeenergia,informaciondeenergia,agua,controldeagua,informaciondeagua,aire,controldeaire,informaciondeaire,comunidad,ruido,suelo,recursosnaturales,reportecontroldeenergeticos,gestion,atencionaemergencias,higiene,identificacionycontrolderiesgos,prevencionentrabajospeligrosos,perservaciondelasalud,historialclinico,drp,controles,riesgotecnologico,mantenimiento,bcp,circulares,cadenaalimentaria,riesgosalimentarios,manipulaciondealimentos,medicion,cafeteriadeanfitriones,inocuidad,circulares,accidentes_enfermedades',
                'carpetas_acceso' => 'nullable|array',
                'carpetas_acceso.*' => 'integer|exists:carpetas,id',
            ]);

            Log::info('✅ Datos validados correctamente:', $validated);

            $user = User::create([
                'name' => $validated['name'],
                'apellido_paterno' => $validated['apellido_paterno'],
                'rfc' => $validated['rfc'],
                'password' => Hash::make($validated['password']),
                'departamento' => $validated['departamento'],
                'propiedad_id' => $validated['propiedad_id'] ?? null,
            ]);

            Log::info("✅ Usuario creado con éxito. ID del usuario: {$user->id}");

            if ($request->has('acceso')) {
                $secciones = [
                    'calidad' => 'acceso_calidad',
                    'ambiental' => 'acceso_seguridadambiental',
                    'salud' => 'acceso_seguridadysalud',
                    'informacion' => 'acceso_seguridadinformacion',
                    'alimentaria' => 'acceso_seguridadalimentaria',
                    'contextoorg' => 'acceso_contextoorg',
                    'liderazgo' => 'acceso_liderazgo',
                    'planificacion' => 'acceso_planificacion',
                    'apoyo' => 'acceso_apoyo',
                    'documentacionmi' => 'acceso_documentacionmi',
                    'mireservaciondeeventos' => 'acceso_mireservaciondeeventos',
                    'controldocumental' => 'acceso_controldocumental',
                    'documentaciondelaoperacion' => 'acceso_documentaciondelaoperacion',
                    'procesosoperativos' => 'acceso_procesosoperativos',
                    'procesosdeapoyo' => 'acceso_procesosdeapoyo',
                    'evaldesempeño' => 'acceso_evaldesempeño',
                    'revenuereports' => 'acceso_revenuereports',
                    'balancescorecard' => 'acceso_balancescorecard',
                    'mejora' => 'acceso_mejora',
                    'controlplanesdeaccion' => 'acceso_controlplanesdeaccion',
                    'residuos' => 'acceso_residuos',
                    'controlderesiduos' => 'acceso_controlderesiduos',
                    'reportederesiduos' => 'acceso_reportederesiduos',
                    'energia' => 'acceso_energia',
                    'controldeenergia' => 'acceso_controldeenergia',
                    'informaciondeenergia' => 'acceso_informaciondeenergia',
                    'agua' => 'acceso_agua',
                    'controldeagua' => 'acceso_controldeagua',
                    'informaciondeagua' => 'acceso_informaciondeagua',
                    'aire' => 'acceso_aire',
                    'controldeaire' => 'acceso_controldeaire',
                    'informaciondeaire' => 'acceso_informaciondeaire',
                    'comunidad' => 'acceso_comunidad',
                    'ruido' => 'acceso_ruido',
                    'suelo' => 'acceso_suelo',
                    'recursosnaturales' => 'acceso_recursosnaturales',
                    'reportecontroldeenergeticos' => 'acceso_reportecontroldeenergeticos',
                    'gestion' => 'acceso_gestion',
                    'atencionaemergencias' => 'acceso_atencionaemergencias',
                    'higiene' => 'acceso_higiene',
                    'identificacionycontrolderiesgos' => 'acceso_identificacionycontrolderiesgos',
                    'prevencionentrabajospeligrosos' => 'acceso_prevencionentrabajospeligrosos',
                    'perservaciondelasalud' => 'acceso_perservaciondelasalud',
                    'historialclinico' => 'acceso_historialclinico',
                    'drp' => 'acceso_drp',
                    'controles' => 'acceso_controles',
                    'riesgotecnologico' => 'acceso_riesgotecnologico',
                    'mantenimiento' => 'acceso_mantenimiento',
                    'bcp' => 'acceso_bcp',
                    'cadenaalimentaria' => 'acceso_cadenaalimentaria',
                    'riesgosalimentarios' => 'acceso_riesgosalimentarios',
                    'manipulaciondealimentos' => 'acceso_manipulaciondealimentos',
                    'medicion' => 'acceso_medicion',
                    'cafeteriadeanfitriones' => 'acceso_cafeteriadeanfitriones',
                    'inocuidad' => 'acceso_inocuidad',
                    'circulares' => 'acceso_circulares',
                    'accidentes_enfermedades' => 'acceso_accidentes_enfermedades',
                ];

                $privilegiosData = ['user_id' => $user->id];

                foreach ($secciones as $claveFormulario => $nombreColumna) {
                    $privilegiosData[$nombreColumna] = in_array($claveFormulario, $request->input('acceso', [])) ? 1 : 0;
                }

                Log::info('🛠 Datos a insertar en la tabla privilegios:', $privilegiosData);
                Privilegios::create($privilegiosData);
                Log::info('✅ Privilegios guardados exitosamente.');
            } else {
                Log::warning('⚠ No se seleccionaron privilegios para el usuario.');
            }

            $carpetasSeleccionadas = $request->input('carpetas_acceso', []);

            foreach ($carpetasSeleccionadas as $carpeta_id) {
                DB::table('privilegios_carpetas')->insert([
                    'user_id' => $user->id,
                    'carpeta_id' => $carpeta_id
                ]);
            }

            Log::info('✅ Carpetas asignadas exitosamente: ', $carpetasSeleccionadas);

            return redirect()->route('dashboard.crearuser')->with('success', 'Usuario registrado exitosamente.');
        } catch (\Exception $e) {
            Log::error('❌ Error al registrar usuario: ' . $e->getMessage(), [
                'exception' => $e,
                'data' => $request->all(),
            ]);

            return redirect()->back()->withErrors('Error al registrar el usuario. Revisa los datos e inténtalo de nuevo.');
        }
    }

    public function buscar(Request $request)
    {
        $query = $request->input('query');
        $usuarios = User::where('name', 'LIKE', "%$query%")->get();
        $carpetas = DB::table('carpetas')->get(['id', 'nombre_carpeta']);
        return view('administracion.crearuser', compact('usuarios', 'carpetas'));
    }

    // 🔽 AGREGADO: para cargar dinámicamente departamentos y puestos

    public function getDepartamentos($id)
    {
        return response()->json(
            Departamento::where('propiedad_id', $id)->get()
        );
    }
    
    public function getPuestos($departamento_id)
    {
        return Puestos::where('departamento_id', $departamento_id)
                    ->select('id', 'puesto') // 👈 Asegúrate de esto
                    ->get();
    }


}
