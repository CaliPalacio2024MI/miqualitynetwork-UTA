<?php

namespace App\Http\Controllers\Calidad\Seguridadysalud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormularioAccidente;

class FormularioAccidenteController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        // Si se subió imagen, guárdala
        if ($request->hasFile('memoria_fotografica')) {
            $data['memoria_fotografica'] = $request->file('memoria_fotografica')->store('public/fotografias');
        }

        // Transforma checkboxes (on/off) en boolean (1 o 0)
        $checkboxes = [
            'cabeza', 'ojo', 'oido', 'brazo', 'mano',
            'espalda', 'dedos', 'pierna', 'cara', 'torso',
            'incapacidad_temporal', 'incapacidad_parcial',
            'incapacidad_muerte', 'sin_incapacidad', 'no_especificada'
        ];

        foreach ($checkboxes as $campo) {
            $data[$campo] = $request->has($campo) ? 1 : 0;
        }

        // Guarda el formulario en la base de datos
        FormularioAccidente::create($data);

        return redirect()->back()->with('success', 'Formulario guardado correctamente.');
    }
}
