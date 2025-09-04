<?php

namespace App\Http\Controllers;

use App\Models\Recogida;
use App\Models\Shipment;
use Illuminate\Http\Request;

class RecogidaController extends Controller
{
    public function index()
    {
        $recogidas = Recogida::with('envio.cliente')->get();
        return view('recogidas.index', compact('recogidas'));
    }

    public function create()
    {
        $shipment = Shipment::all();
        return view('recogidas.create', compact('shipments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipment_id'=>'required|exists:shipments,id',
            'fecha_recogida'=>'required|date',
            'observaciones'=>'nullable|string'
        ]);
        Recogida::create($request->all());
        return redirect()->route('recogidas.index');
    }

    public function edit(Recogida $recogida)
    {
        $shipments = Shipment::all();
        return view('recogidas.edit', compact('recogida','shipment'));
    }

    public function update(Request $request, Recogida $recogida)
    {
        $request->validate([
            'envio_id'=>'required|exists:shipments,id',
            'fecha_recogida'=>'required|date',
            'observaciones'=>'nullable|string'
        ]);
        $recogida->update($request->all());
        return redirect()->route('recogidas.index');
    }

    public function destroy(Recogida $recogida)
    {
        $recogida->delete();
        return redirect()->route('recogidas.index');
    }
}
