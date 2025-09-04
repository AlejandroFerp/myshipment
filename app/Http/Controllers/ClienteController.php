<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;
class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        $paises = Countries::all()->pluck('name.common')->sort();
        return view('clientes.create', compact('paises'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'cif'      => 'required|string|max:255|unique:clientes,cif',
            'email'    => 'nullable|email',
            'telefono' => 'nullable|string|max:20',

            // Validación de dirección
            'address_line_1' => 'required|string|max:255',
            'district_city'  => 'required|string|max:255',
            'country'        => 'required|string|max:255',
        ]);

        // Crear cliente
        $cliente = Cliente::create($request->only(['nombre','cif','email','telefono']));

        // Crear dirección asociada
        $cliente->direcciones()->create($request->only([
            'name',
            'description',
            'address_line_1',
            'address_line_2',
            'district_city',
            'state_province',
            'postal_code',
            'country',
            'latitude',
            'longitude',
        ]));

        return redirect()->route('clientes.index')->with('success', 'Cliente creado con dirección');
    }


    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre'=>'required|string|max:255',
            'cif'=>'required|string|max:255'
        ]);
        $cliente->update($request->all());
        return redirect()->route('clientes.index');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index');
    }
}
