<?php

namespace App\Http\Controllers;

use App\Models\Autorizacion;
use Illuminate\Http\Request;

class AutorizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $autorizaciones = Autorizacion::all();
        return view('autorizaciones.index', compact('autorizaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('autorizaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:autorizaciones,nombre',
            'codigo' => 'required|unique:autorizaciones,codigo',
            'descripcion' => 'nullable|string',
        ]);

        Autorizacion::create($request->all());

        return redirect()->route('autorizaciones.index')
                         ->with('success', 'Autorización creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Autorizacion $autorizacion)
    {
        return view('autorizaciones.show', compact('autorizacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Autorizacion $autorizacion)
    {
        return view('autorizaciones.edit', compact('autorizacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Autorizacion $autorizacion)
    {
        $request->validate([
            'nombre' => 'required|unique:autorizaciones,nombre,' . $autorizacion->id,
            'codigo' => 'required|unique:autorizaciones,codigo,' . $autorizacion->id,
            'descripcion' => 'nullable|string',
        ]);

        $autorizacion->update($request->all());

        return redirect()->route('autorizaciones.index')
                         ->with('success', 'Autorización actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Autorizacion $autorizacion)
    {
        $autorizacion->delete();

        return redirect()->route('autorizaciones.index')
                         ->with('success', 'Autorización eliminada correctamente.');
    }
}
