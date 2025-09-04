<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    public function index()
    {
        $documentos = Documento::with('shipment.cliente')->get();
        return view('documentos.index', compact('documentos'));
    }

    public function create()
    {
        $shipment = Shipment::all();
        return view('documentos.create', compact('shipment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipment_id'=>'required|exists:shipment,id',
            'tipo'=>'required|string',
            'archivo'=>'required|file'
        ]);

        $ruta = $request->file('archivo')->store('documentos');

        Documento::create([
            'shipment_id'=>$request->envio_id,
            'tipo'=>$request->tipo,
            'ruta_archivo'=>$ruta
        ]);

        return redirect()->route('documentos.index');
    }

    public function edit(Documento $documento)
    {
        $shipment = Shipment::all();
        return view('documentos.edit', compact('documento','shipment'));
    }

    public function update(Request $request, Documento $documento)
    {
        $request->validate([
            'envio_id'=>'required|exists:shipment,id',
            'tipo'=>'required|string',
            'archivo'=>'nullable|file'
        ]);

        if($request->hasFile('archivo')){
            Storage::delete($documento->ruta_archivo);
            $documento->ruta_archivo = $request->file('archivo')->store('documentos');
        }

        $documento->envio_id = $request->envio_id;
        $documento->tipo = $request->tipo;
        $documento->save();

        return redirect()->route('documentos.index');
    }

    public function destroy(Documento $documento)
    {
        Storage::delete($documento->ruta_archivo);
        $documento->delete();
        return redirect()->route('documentos.index');
    }
}
