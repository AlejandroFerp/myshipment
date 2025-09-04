<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    // Mostrar todos los paquetes
    public function index()
    {
        $packages = Package::all();
        return view('packages.index', compact('packages'));
    }

    // Mostrar formulario para crear un nuevo paquete
    public function create()
    {
        return view('packages.create');
    }

    // Guardar un paquete nuevo
    public function store(Request $request)
    {
        $request->validate([
            'Reference' => 'required|unique:packages,Reference',
            'Shipments' => 'required',
            'Type_cargo' => 'required',
            'Weight_Kg' => 'nullable|numeric',
            'units' => 'nullable|numeric',
            'Volume_cubic' => 'nullable|numeric',
            'Description' => 'nullable|string',
            'Cost' => 'nullable|numeric',
        ]);

        $package = Package::create($request->all());

        return redirect()->route('packages.index')
                         ->with('success', 'Package Added Successfully');
    }

    // Mostrar un paquete
    public function show(Package $package)
    {
        return view('packages.show', compact('package'));
    }

    // Mostrar formulario para editar un paquete
    public function edit(Package $package)
    {
        return view('packages.edit', compact('package'));
    }

    // Actualizar paquete
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'Reference' => 'required|unique:packages,Reference,' . $package->id,
            'Shipments' => 'required',
            'Type_cargo' => 'required',
            'Weight_Kg' => 'nullable|numeric',
            'units' => 'nullable|numeric',
            'Volume_cubic' => 'nullable|numeric',
            'Description' => 'nullable|string',
            'Cost' => 'nullable|numeric',
        ]);

        $package->update($request->all());

        return redirect()->route('packages.index')
                         ->with('success', 'Package Updated Successfully');
    }

    // Eliminar un paquete
    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('packages.index')
                         ->with('success', 'Package Deleted Successfully');
    }
}
