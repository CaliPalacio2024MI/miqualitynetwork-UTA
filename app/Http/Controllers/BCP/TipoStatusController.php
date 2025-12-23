<?php

namespace App\Http\Controllers\BCP;

use Illuminate\Http\Request;
use App\Models\BCP\TipoStatus;
use App\Http\Controllers\Controller;

class TipoStatusController extends Controller
{
    public function index()
    {
        $tipos = TipoStatus::orderBy('Nombre', 'asc')->get();
        return view('seguridaddelainformacion.bcp.tipo_status', compact('tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:200',
            'Codigo' => 'required|string|max:10|unique:tipo_status,Codigo',
            'Color'  => 'required|string|max:50',
        ], [
            'Codigo.unique' => 'El Código ya existe',
            'Codigo.max' => 'El Codigo debe ser menor a 10 valores'
        ]);

        TipoStatus::create([
            'Nombre' => $request->Nombre,
            'Codigo' => $request->Codigo,
            'Color'  => $request->Color,
        ]);

        return redirect()->back()->with('success', 'Tipo de Status guardado');
    }

    public function destroy($Codigo)
    {
        $status = TipoStatus::where('Codigo', $Codigo)->first();

        if ($status) {
            $status->delete();
            return redirect()->back()->with('success', 'Tipo de Status eliminado con éxito');
        } else {
            return redirect()->back()->with('error', 'Habitación no encontrada');
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'Nombre' => 'required|string|max:200',
            'Codigo' => 'required|string|max:10|unique:tipo_status,Codigo,' . $id . ',Codigo',
            'Color'  => 'required|string|max:50',
        ], [
            'Codigo.unique' => 'El Código ya existe',
            'Codigo.max' => 'El Codigo debe ser menor a 10 valores'
        ]);

        $habitacion = TipoStatus::findOrFail($id);

        $habitacion->Nombre = $validated['Nombre'];
        $habitacion->Codigo = $validated['Codigo'];
        $habitacion->Color = $validated['Color'];

        $habitacion->save();

        return redirect()->route('tipo_status.index')->with('success', 'Tipo de Status actualizado correctamente');
    }
}
