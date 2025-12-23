<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Propiedades;
use Illuminate\Support\Facades\Log;

//ESTE CONTROLADOR SOLO HACE LA LOGICA DE GUARDAR PROPIEDADES EN LA BASE DE DATOS
class crearPropiedadesController extends Controller
{
    public function crearpropiedades(Request $request)
    {
        try {
            // Se registra en el log todo lo que viene del formulario
            Log::info('Datos recibidos para crear propiedad:', $request->all());

            // Se valida que el campo "nombre" venga, sea texto, no pase de 255 caracteres y no esté repetido
            $validated = $request->validate([
                'nombre' => 'required|string|max:255|unique:propiedades,nombre_propiedad',
            ]);

            // Se guarda la nueva propiedad en la base de datos
            $propiedad = Propiedades::create([
                'nombre_propiedad' => $validated['nombre'],
            ]);

            // Se deja registro en el log con el ID de la propiedad creada
            Log::info("Propiedad registrada con éxito. ID: {$propiedad->id_propiedad}");

            // Se redirige a la misma página con un mensaje de éxito
            return redirect()->back()->with('success', '');
        } catch (\Exception $e) {
            // Si ocurre un error, se registra en el log y se muestra un mensaje de error al usuario
            Log::error('Error al registrar la propiedad: ' . $e->getMessage());

            return redirect()->back()->withErrors('Error al registrar la propiedad. Inténtalo de nuevo.');
        }
    }
}
