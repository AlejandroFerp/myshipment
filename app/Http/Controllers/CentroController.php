<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use App\Models\Cliente;
use App\Models\Direccion;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf as PdfWriter;

class CentroController extends Controller
{
    public function index(Request $request)
    {
        $query = Centro::with(['cliente', 'direccion'])->latest();
        // Filtrar por cliente si viene en la query string
        if ($request->has('cliente_id') && !empty($request->cliente_id)) {
            $query->where('cliente_id', $request->cliente_id);
        }
        // Ejecutar la consulta con paginación
        $centros = $query->paginate(15);
        return view('centros.index', compact('centros'));
    }

    public function create(Request $request)
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $direcciones = Direccion::orderBy('id')->get();
        // Leer cliente_id desde query string para preseleccionarlo
        $cliente_id = $request->get('cliente_id');
        return view('centros.create', compact('clientes','direcciones', 'cliente_id'));
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
        return view('centros.index', compact('centro'));
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

    
public function generarContrato(Centro $centro)
{
    // Convertimos en objeto directamente con (object)
    $contrato = (object) [
        'numero_ct'            => 'CT-' . str_pad($centro->id, 5, '0', STR_PAD_LEFT),
        'fecha'                => now()->format('d/m/Y'),
        'fecha_inicio'         => now()->format('d/m/Y'),
        'fecha_fin'            => now()->addYear()->format('d/m/Y'),

        // Origen / operador del traslado
        'origen_nif'           => $centro->cliente->cif ?? '',
        'origen_razon_social'  => $centro->cliente->nombre ?? '',
        'origen_nima'          => $centro->nima ?? '',
        'origen_nombre_centro' => $centro->nombre_comercial ?? '',
        'origen_direccion'     => $centro->direccion->address_line_1 ?? '',
        'origen_cp'            => $centro->direccion->postal_code ?? '',
        'origen_municipio'     => $centro->direccion->district_city ?? '',
        'origen_provincia'     => $centro->direccion->state_province ?? '',
        'origen_telefono'      => $centro->telefono ?? '',
        'origen_email'         => $centro->email ?? '',

        // Destino (ejemplo fijo, cámbialo si quieres que sea dinámico)
        'destino_nif'          => 'B16735805',
        'destino_razon_social' => 'GDV GESTION Y DISTRIBUCION S.L.',
        'destino_nima'         => '0300025443',
        'destino_nombre_centro'=> 'CENTRAL',
        'destino_direccion'    => 'Calle Sagitario, 5',
        'destino_cp'           => '03006',
        'destino_municipio'    => 'Alicante',
        'destino_provincia'    => 'Alicante',
        'destino_telefono'     => '865 55 08 70',
        'destino_email'        => 'residuos@gdvmobility.com',

        // Residuos
        'codigo_ler'           => '160605',
        'descripcion_residuo'  => 'Baterías de litio',
        'tratamiento'          => 'R04',
        'hp'                   => 'HP6',
        'cantidad'             => '1200',
    ];

    // Generar PDF con la vista Blade
    $pdf = Pdf::loadView('pdf.CT', compact('contrato'))
              ->setPaper('A4', 'portrait');

    $fileName = 'CT_' . $centro->id . '_' . now()->format('Ymd_His') . '.pdf';

    return $pdf->download($fileName);
}




    public function destroy(Centro $centro)
    {
        $centro->delete();
        return redirect()->route('centros.index')->with('success', 'Centro eliminado.');
    }
}
