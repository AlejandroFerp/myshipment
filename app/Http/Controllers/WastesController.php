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
        $wastes = Waste::with('listaLer')->get();
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
            'lista_ler_id' => 'nullable|exists:lista_ler,id', // selección de LER
            'code' => 'required|string|max:50|unique:wastes,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
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
            'lista_ler_id' => 'nullable|exists:lista_ler,id', // selección de LER
            'code' => "required|string|max:50|unique:wastes,code,{$waste->id}",
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
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
