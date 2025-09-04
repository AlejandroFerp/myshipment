<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Carrier;
use App\Models\Direccion; // <- cambiar Address por Direccion
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    // Mostrar todos los envíos
    public function index()
    {
        $shipments = Shipment::with(['packages', 'carrier', 'origin', 'destiny'])->get();
        return view('shipments.index', compact('shipments'));
    }

    // Formulario para crear un envío
    public function create()
    {
        $addresses = Direccion::all(); // <- usar modelo Direccion
        return view('shipments.create', compact('addresses'));
    }

    // Guardar un envío
    public function store(Request $request)
    {
        $validated = $request->validate([
            'internal_reference' => 'required|unique:shipments,internal_reference',
            'client' => 'required|string',
            'carrier_id' => 'required|exists:carriers,id',
            'fuel_cost' => 'nullable|numeric',
            'shipment_cost' => 'nullable|numeric',
            'date_field' => 'required|date',
            'arrival_date' => 'nullable|date',
            'origin_address_id' => 'required|exists:direcciones,id', // <- tabla en español
            'destiny_address_id' => 'required|exists:direcciones,id', // <- tabla en español
        ]);

        $shipment = Shipment::create($validated);

        return redirect()->route('shipments.index')->with('success', 'Shipment Added Successfully');
    }

    // Mostrar un envío específico
    public function show(Shipment $shipment)
    {
        $shipment->load(['packages', 'origin', 'destiny']);
        return view('shipments.show', compact('shipment'));
    }

    // Formulario para editar un envío
    public function edit(Shipment $shipment)
    {
        $addresses = Direccion::all(); // <- usar modelo Direccion
        return view('shipments.edit', compact('shipment', 'addresses'));
    }

    // Actualizar un envío
    public function update(Request $request, Shipment $shipment)
    {
        $validated = $request->validate([
            'internal_reference' => 'required|unique:shipments,internal_reference,' . $shipment->id,
            'client' => 'required|string',
            'carrier_id' => 'required|exists:carriers,id',
            'fuel_cost' => 'nullable|numeric',
            'shipment_cost' => 'nullable|numeric',
            'date_field' => 'required|date',
            'arrival_date' => 'nullable|date',
            'origin_address_id' => 'required|exists:direcciones,id', // <- tabla en español
            'destiny_address_id' => 'required|exists:direcciones,id', // <- tabla en español
        ]);

        $shipment->update($validated);

        return redirect()->route('shipments.index')->with('success', 'Shipment Updated Successfully');
    }

    // Eliminar un envío
    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return redirect()->route('shipments.index')->with('success', 'Shipment Deleted Successfully');
    }
}
