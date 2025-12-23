<?php
namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Propiedades;
use Illuminate\Support\Facades\Log;
use App\Models\User;

//ESTE CONTROLADOR SOLO HACE LA LOGICA DE BORRAR PROPIEDADES
class borrarPropiedadesController extends Controller
{
    public function borrar(Request $request) {
        
        $validated = $request->validate([
            'id' => 'required|integer|exists:propiedades,id_propiedad',
        ]);
    
        try {
            
            $usersUpdated = User::where('propiedad_id', $validated['id'])
                              ->update(['propiedad_id' => NULL]); 
    
            Log::info("Usuarios actualizados a 0: {$usersUpdated}, Propiedad ID: {$validated['id']}");
    
           
            $deleted = Propiedades::where('id_propiedad', $validated['id'])->delete();
    
            if (!$deleted) {
                Log::error("No se pudo eliminar la propiedad ID: {$validated['id']}");
                return back()->withErrors('');
            }
    
            return back()->with('');
    
        } catch (\Exception $e) {
            Log::error("Error completo: " . $e->getMessage());
            return back()->withErrors('Error: ' . $e->getMessage());
        }
    }
    public function actualizar_propiedad(Request $request){
        try {
            Log::info('Datos recibidos para modificar propiedad:', $request->all());

            $validated = $request->validate([
                'id_propiedad' => 'required|integer|exists:propiedades,id_propiedad',
                'nombre_propiedad' => 'required|string|max:255',
            ]);

            $propiedad = Propiedades::findOrFail($validated['id_propiedad']);
            $propiedad->nombre_propiedad = $validated['nombre_propiedad'];
            $propiedad->save();

            return redirect()->back()->with('terminado', '');
        } catch (\Exception $e) {
            Log::error('Error al actualizar propiedad: ' . $e->getMessage());
            return redirect()->back()->withErrors(['']);
        }
    }
}
