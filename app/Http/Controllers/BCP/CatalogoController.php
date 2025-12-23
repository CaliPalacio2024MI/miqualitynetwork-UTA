<?php

namespace App\Http\Controllers\BCP;

use Illuminate\Http\Request;
use App\Models\BCP\Catalogo;
use App\Models\BCP\Creditos;
use App\Http\Controllers\Controller;

class CatalogoController extends Controller
{
    public function index()
    {
        $habitaciones = Catalogo::orderBy('N_Hab', 'asc')->get();
        return view('seguridaddelainformacion.bcp.catalogo', compact('habitaciones'));
    }

    public function asignacion()
    {
        $secciones = Catalogo::whereNotNull('Secciones')
            ->select('Secciones')
            ->distinct()
            ->orderBy('Secciones', 'asc')
            ->pluck('Secciones');

        $credito = Creditos::value('creditos'); // o ->where('id_creditos', 1)->value('creditos');

        return view('seguridaddelainformacion.bcp.asignacion', compact('secciones', 'credito'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'N_Hab' => 'required|integer|unique:catalogo,N_Hab',
            'Tp_Hab' => 'required|string|max:15',
            'Edificio' => 'required|string|min:1|max:15',
            'Piso' => 'required|integer|min:1',
            'Cred_Pasaje' => 'required|integer|min:1',
            'Cred_Salida' => 'required|integer|min:1',
        ], [
            'N_Hab.unique' => 'El número de esta habitación ya está ocupado',
            'Edificio.min' => 'El número de Edificio debe ser al menos 1',
            'Piso.min' => 'El número de Piso debe ser al menos 1',
            'Cred_Pasaje.min' => 'El número de Cred. Pasaje debe ser al menos 1',
            'Cred_Salida.min' => 'El número de Cred. Salida debe ser al menos 1'
        ]);

        try {
            $datos = $request->all();
            $datos['Status'] = 'VA-S'; // Asignar el valor por defecto

            Catalogo::create($datos);
            return redirect()->route('catalogo.index')->with('success', 'Habitación guardada con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }


    public function destroy($N_Hab)
    {
        $habitacion = Catalogo::find($N_Hab);

        if ($habitacion) {
            $habitacion->delete();
            return response()->json(['success' => true, 'message' => 'Habitación eliminada con éxito']);
        } else {
            return response()->json(['success' => false, 'message' => 'Habitación no encontrada'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        // Valida los datos si es necesario
        $validated = $request->validate([
            'Tp_Hab' => 'required|string|max:15',
            'Edificio' => 'required|string|min:1|max:15',
            'Piso' => 'required|integer|min:1',
            'Cred_Pasaje' => 'required|integer|min:1',
            'Cred_Salida' => 'required|integer|min:1',
        ], [
            'N_Hab.unique' => 'El número de esta habitación ya está ocupado',
            'Edificio.min' => 'El número de Edificio debe ser al menos 1',
            'Piso.min' => 'El número de Piso debe ser al menos 1',
            'Cred_Pasaje.min' => 'El número de Cred. Pasaje debe ser al menos 1',
            'Cred_Salida.min' => 'El número de Cred. Salida debe ser al menos 1'
        ]);

        $habitacion = Catalogo::findOrFail($id);

        // Actualiza los campos
        $habitacion->Tp_Hab = $validated['Tp_Hab'];
        $habitacion->Edificio = $validated['Edificio'];
        $habitacion->Piso = $validated['Piso'];
        $habitacion->Cred_Pasaje = $validated['Cred_Pasaje'];
        $habitacion->Cred_Salida = $validated['Cred_Salida'];

        $habitacion->save();

        return redirect()->route('catalogo.index')->with('success', 'Habitación actualizada correctamente');
    }
}
