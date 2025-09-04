<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;

class DireccionController extends Controller
{
    public function index()
    {
        $direcciones = Direccion::all();
        return view('direcciones.index', compact('direcciones'));
    }

    public function create()
    {
        $paises = Countries::all()->pluck('name.common')->sort();
        return view('direcciones.create', compact('paises'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'section' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'district_city' => 'nullable|string|max:255',
            'state_province' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        Direccion::create($request->all());

        return redirect()->route('direcciones.index')->with('success', 'Dirección agregada correctamente');
    }

    public function edit(Direccion $direccion)
    {
        return view('direcciones.edit', compact('direccion'));
    }

    public function update(Request $request, Direccion $direccion)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'district_city' => 'nullable|string|max:255',
            'state_province' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $direccion->update($request->all());

        return redirect()->route('direcciones.index')->with('success', 'Dirección actualizada correctamente');
    }

    public function destroy(Direccion $direccion)
    {
        $direccion->delete();
        return redirect()->route('direcciones.index')->with('success', 'Dirección eliminada correctamente');
    }
}
