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
use Illuminate\Support\Facades\Cache;
use App\Models\Carpetas;
use App\Models\Archivo;

class vistaeditaranfitrionController extends Controller
{
//ESTE CONTROLADOR LLAMA A LA VISTA modificadorUser.blade
    public function modificador()
    {
        // Se obtiene el usuario autenticado
        $user = Auth::user();

        // Se verifica si tiene permisos para administrar usuarios
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            $mensaje = 1;
            return view('layouts.dashboard', compact('mensaje'));
        }

        // Se obtienen todos los usuarios junto con sus privilegios
        $usuarios = User::with('privilegios')->get(['id', 'name', 'apellido_paterno', 'rfc', 'departamento', 'propiedad_id']);


        // Se carga la vista que muestra todos los usuarios para poder modificarlos
        return view('administracion.modificadorUser', compact('usuarios'));
    }
//ESTA FUNCION SIRVE COMO FILTRO PARA ENCONTRE UNO O VARIOS ANFITRIONES CON EL MISMO NOMBRE LA BARRA DE BUSQUEDA LE MANDA UNA ID
    public function buscador(Request $request)
    {
        // Se obtiene el usuario autenticado
        $user = Auth::user();

        // Se verifica si tiene permisos para administrar usuarios
        if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
            $mensaje = 1;
            return view('layouts.dashboard', compact('mensaje'));
        }

        // Se obtiene el texto que el usuario escribió en el buscador
        $query = $request->input('query');

        // Se buscan usuarios cuyo nombre coincida parcialmente con el texto ingresado
        $usuarios = User::where('name', 'LIKE', "%$query%")->get();
        // Se obtienen todas las propiedades y carpetas
        $propiedades = Propiedades::all();
        $carpetas = DB::table('carpetas')->get(['id', 'nombre_carpeta','ruta']);

        // Se carga nuevamente la vista crearuser con los datos filtrados
        return view('administracion.crearuser', [
            'usuarios' => $usuarios,
            'propiedades' => $propiedades,
            'carpetas' => $carpetas
        ]);
    }

//ESTA FUNCION LLAMA A LA VISTA edicionAnfitrion.blade ESTA VISTA SIRVE PARA MODIFICAR UN SOLO USUARIO LLAMADO DESDE crearuser.blade
    public function editarAnfitrion($id)
    {
        // Se obtiene el usuario autenticado
    $user = Auth::user();

    // Se verifica si tiene permisos para administrar usuarios
    if (!$user->privilegios || !$user->privilegios->acceso_administrarusuarios) {
        $mensaje = 1;
        return view('layouts.dashboard', compact('mensaje'));
    }

    // Se busca el usuario específico por ID, incluyendo sus privilegios
    $usuariodefinido = User::with('privilegios')->findOrFail($id);

    // Se obtienen todas las propiedades disponibles
    $propiedad = Propiedades::all();

    $llave_foranea_anfitrion_propiedad = User::where('id', $id)->value('propiedad_id');
    if($llave_foranea_anfitrion_propiedad==NULL){
        $propiedad_pertenece_anfitrion ='Sin propiedad asignada';
    }else{
        $propiedad_pertenece_anfitrion = Propiedades::Where('id_propiedad',$llave_foranea_anfitrion_propiedad)->value('nombre_propiedad');;
    }
    

    // Se obtienen todas las carpetas disponibles
    $carpetas = DB::table('carpetas')->get();

    // Se consultan las carpetas a las que el usuario tiene acceso
    $carpetasAcceso = DB::table('privilegios_carpetas')
        ->where('user_id', $id)
        ->pluck('carpeta_id')
        ->toArray();

    // Se carga la vista para editar ese usuario en particular
    return view('administracion.edicionAnfitrion', compact(
        'usuariodefinido',
        'propiedad',
        'carpetas',
        'carpetasAcceso',
        'propiedad_pertenece_anfitrion'
    ));
    }
}
