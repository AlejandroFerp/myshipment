<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use App\Models\Cliente;
use App\Models\Direccion;
use Illuminate\Http\Request;

class CentroController extends Controller
{
    public function index()
    {
        $centros = Centro::with(['cliente', 'direccion'])->latest()->paginate(15);
        return view('centros.index', compact('centros'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $direcciones = Direccion::orderBy('id')->get();
        return view('centros.create', compact('clientes','direcciones'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_id'       => 'required|exists:clientes,id',
            'direccion_id'     => 'nullable|exists:direcciones,id',
            'nombre_comercial' => 'required|string|max:255',
            'nima'             => 'nullable|string|max:100',
            'tarifa'           => 'nullable|numeric',
            'nombre_contacto'  => 'nullable|string|max:255',
            'telefono'         => 'nullable|string|max:50',
            'email'            => 'nullable|email|max:255',
            'detalle_envio'    => 'nullable|string',
        ]);

        Centro::create($data);

        return redirect()->route('centros.index')->with('success', 'Centro creado correctamente.');
    }

    public function show(Centro $centro)
    {
        $centro->load(['cliente','direccion']);
        return view('centros.show', compact('centro'));
    }

    public function edit(Centro $centro)
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $direcciones = Direccion::orderBy('id')->get();
        return view('centros.edit', compact('centro','clientes','direcciones'));
    }

    public function update(Request $request, Centro $centro)
    {
        $data = $request->validate([
            'cliente_id'       => 'required|exists:clientes,id',
            'direccion_id'     => 'nullable|exists:direcciones,id',
            'nombre_comercial' => 'required|string|max:255',
            'nima'             => 'nullable|string|max:100',
            'tarifa'           => 'nullable|numeric',
            'nombre_contacto'  => 'nullable|string|max:255',
            'telefono'         => 'nullable|string|max:50',
            'email'            => 'nullable|email|max:255',
            'detalle_envio'    => 'nullable|string',
        ]);

        $centro->update($data);

        return redirect()->route('centros.index')->with('success', 'Centro actualizado correctamente.');
    }

    public function destroy(Centro $centro)
    {
        $centro->delete();
        return redirect()->route('centros.index')->with('success', 'Centro eliminado.');
    }
}
