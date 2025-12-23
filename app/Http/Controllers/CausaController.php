<?php

namespace App\Http\Controllers;

use App\Models\Causa;
use Illuminate\Http\Request;


class CausaController extends Controller
{
    /**
     * Display a listing of the resource.
     * Si la petición es AJAX/JSON, devuelve todas las causas en JSON.
     * Si es petición web, carga la vista de listado Blade.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json(Causa::all());
        }

        return redirect()->route('admin.causas.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Vista Blade con el formulario para nueva causa
        return view('causas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Causa::create($request->only('nombre'));

        return redirect()
            ->route('admin.causas.index') //esta es la vista con modal
            ->with('success', 'Causa creada correctamente');
    }


    /**
     * Display the specified resource.
     */
    public function show(Causa $causa)
    {
        return view('causas.show', compact('causa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Causa $causa)
    {
        return view('causas.edit', compact('causa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Causa $causa)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $causa->update($request->only('nombre'));

        return redirect()
            ->route('admin.causas.index')
            ->with('success', 'Causa actualizada correctamente');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Causa $causa)
    {
        $causa->delete();

        return redirect()
            ->route('admin.causas.index')
            ->with('success', 'Causa eliminada correctamente');
    }

    // 👇 Agrega aquí tu método de vista tipo panel
    public function listado()
    {
        $causas = Causa::all();
        return view('administracion.causas', compact('causas'));
    }


}