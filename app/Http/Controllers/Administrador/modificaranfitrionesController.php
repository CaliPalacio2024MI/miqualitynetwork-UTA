<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Privilegios;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

//ESTE CONTROLADOR ES LA PARTE LOGICA QUE MODIFICA EL USUARIO SELECCIONADO
class modificaranfitrionesController extends Controller
{
    public function modificar(Request $request)
    {
        try {
            // Log inicial para registrar todos los datos recibidos
            Log::info('📥 Datos recibidos para modificar usuario:', $request->all());

            // Validaciones de los datos recibidos
            $validated = $request->validate([
                'id' => 'required|integer|exists:users,id',
                'name' => 'required|string|max:255',
                'apellido_paterno' => 'required|string|max:255',
                'rfc' => 'required|string|max:13',
                'password' => 'nullable|string|min:6',
                'departamento' => 'required|string|max:255',
                'propiedad_id' => 'required|integer|exists:propiedades,id_propiedad',
                'privilegios' => 'nullable|array',
                'privilegios.*' => 'string',
                'carpetas_acceso' => 'nullable|array',
                'carpetas_acceso.*' => 'integer|exists:carpetas,id',
            ]);

            // Log para verificar los datos validados
            Log::info('✅ Datos validados:', $validated);

            // Se busca el usuario por ID
            $usuario = User::findOrFail($validated['id']);
            Log::info('👤 Usuario encontrado:', ['id' => $usuario->id, 'name' => $usuario->name]);

            // Se actualizan los datos básicos del usuario
            $usuario->update([
                'name' => $validated['name'],
                'apellido_paterno' => $validated['apellido_paterno'],
                'rfc' => $validated['rfc'],
                'departamento' => $validated['departamento'],
                'propiedad_id' => $validated['propiedad_id'] ?? null,
            ]);
            Log::info('✅ Datos básicos del usuario actualizados.');

            // Si el formulario trae una nueva contraseña, se actualiza también
            if (!empty($validated['password'])) {
                $usuario->password = Hash::make($validated['password']);
                $usuario->save();
                Log::info('🔑 Contraseña actualizada.');
            }

            // Si se recibieron privilegios, se procesan
            if ($request->has('privilegios')) {
                // Mapeo de claves del formulario con las columnas de la tabla
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
                    'circulares' => 'acceso_circulares',
                    'cadenaalimentaria' => 'acceso_cadenaalimentaria',
                    'riesgosalimentarios' => 'acceso_riesgosalimentarios',
                    'manipulaciondealimentos' => 'acceso_manipulaciondealimentos',
                    'medicion' => 'acceso_medicion',
                    'cafeteriadeanfitriones' => 'acceso_cafeteriadeanfitriones',
                    'inocuidad' => 'acceso_inocuidad',
                    'accidentes_enfermedades' => 'acceso_accidentes_enfermedades',
                ];

                // Log para verificar los privilegios recibidos
                Log::info('📋 Privilegios recibidos:', $request->input('privilegios', []));

                // Se arman los datos que se van a guardar en la tabla de privilegios
                $privilegiosData = [];

                foreach ($secciones as $claveFormulario => $nombreColumna) {
                    $privilegiosData[$nombreColumna] = in_array($claveFormulario, $request->input('privilegios', [])) ? 1 : 0;
                }

                // Log para verificar los datos procesados de privilegios
                Log::info('🔄 Datos procesados para privilegios:', $privilegiosData);

                // Si el usuario ya tiene privilegios, se actualizan
                if ($usuario->privilegios) {
                    $usuario->privilegios->update($privilegiosData);
                    Log::info('✅ Privilegios actualizados en la base de datos.');
                } else {
                    Log::error('❌ No se encontraron privilegios asociados al usuario.');
                    return redirect()->back()->with('error', 'No se encontraron privilegios asociados al usuario.');
                }
            } else {
                // Si no se seleccionaron privilegios, se deja registro en el log
                Log::warning('⚠ No se seleccionaron privilegios.');
            }

            // --- ACTUALIZACIÓN DE ACCESO A CARPETAS ---
            $todasLasCarpetas = DB::table('carpetas')->pluck('id')->toArray();
            $carpetasSeleccionadas = $request->input('carpetas_acceso', []);

            // Elimina todas las carpetas asociadas al usuario
            DB::table('privilegios_carpetas')->where('user_id', $usuario->id)->delete();

            // Inserta solo las carpetas seleccionadas
            foreach ($carpetasSeleccionadas as $carpeta_id) {
                DB::table('privilegios_carpetas')->insert([
                    'user_id' => $usuario->id,
                    'carpeta_id' => $carpeta_id
                ]);
            }


            return redirect()->back()->with('success', 'Usuario, privilegios y carpetas actualizados correctamente.');
        } catch (\Exception $e) {
            Log::error('❌ Error al modificar usuario: ' . $e->getMessage(), [
                'exception' => $e,
                'data' => $request->all(),
            ]);

            return redirect()->back()->withErrors('Error al modificar el usuario. Revisa los datos e inténtalo de nuevo.');
        }
    }
}
