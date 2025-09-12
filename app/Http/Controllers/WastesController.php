<?php

namespace App\Http\Controllers;

use App\Models\Waste;
use Illuminate\Http\Request;
use App\Models\ListaLer;

class WastesController extends Controller
{
    public function index()
    {
        // Cargamos la relación listaLer para poder usarla si es necesario
        $wastes = Waste::with('ler')->get();
        return view('wastes.index', compact('wastes'));
    }

    public function create()
    {
        $listaLer = ListaLer::all(); // Cargamos opciones LER
        return view('wastes.create', compact('listaLer'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lista_ler_id' => 'required|exists:lista_ler,id',
            'internal_code' => 'required|integer|unique:wastes,internal_code,' . ($waste->id ?? 'NULL'),
            'descripcion_libre' => 'nullable|string',
        ]);

        Waste::create($validated);

        return redirect()->route('wastes.index')
                         ->with('success', 'Waste Added Successfully');
    }

    public function edit(Waste $waste)
    {
        $listaLer = ListaLer::all(); // Cargamos opciones LER
        return view('wastes.edit', compact('waste', 'listaLer'));
    }

    public function update(Request $request, Waste $waste)
    {
        $validated = $request->validate([
            'lista_ler_id'     => 'required|exists:lista_ler,id',
            'internal_code'    => 'required|integer|unique:wastes,internal_code,' . $waste->id,
            'descripcion_libre'=> 'nullable|string',
        ]);


        $waste->update($validated);

        return redirect()->route('wastes.index')
                         ->with('success', 'Waste Updated Successfully');
    }

    public function destroy(Waste $waste)
    {
        $waste->delete();
        return redirect()->route('wastes.index')
                         ->with('success', 'Waste Deleted Successfully');
    }
}
