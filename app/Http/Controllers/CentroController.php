<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use App\Models\Cliente;
use App\Models\Direccion;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;

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
        // Cargar plantilla
        $template = new TemplateProcessor(resource_path('templates/PLANTILLA_CT.docx'));

        // Reemplazar valores de la plantilla
        $template->setValue('{{FECHA}}', now()->format('d/m/Y'));
        $template->setValue('{{NO_CT}}', 'CT-' . str_pad($centro->id, 5, '0', STR_PAD_LEFT));

        // Datos del origen (centro actual)
        $template->setValue('{{RAZON_SOCIAL_O}}', $centro->cliente->nombre ?? '');
        $template->setValue('{{NOMBRE_CENTRO_O}}', $centro->nombre_comercial ?? '');
        $template->setValue('{{DIRECCION_O}}', $centro->direccion->address_line_1 ?? '');
        $template->setValue('{{MUNICIPIO_O}}', $centro->direccion->district_city ?? '');
        $template->setValue('{{CIF_O}}', $centro->cliente->cif ?? '');
        $template->setValue('{{C_POSTAL_O}}', $centro->direccion->postal_code ?? '');
        $template->setValue('{{PROVINCIA_O}}', $centro->direccion->state_province ?? '');
        $template->setValue('{{CONTACTO_O}}', $centro->nombre_contacto ?? '');
        $template->setValue('{{TELEFONO_O}}', $centro->telefono ?? '');
        $template->setValue('{{EMAIL_O}}', $centro->email ?? '');
        $template->setValue('{{NO_PYGR_O}}', $centro->no_pygr ?? '');
        $template->setValue('{{NIMA_O}}', $centro->nima ?? '');

        // Datos de la empresa autorizada (rellena según tu lógica o config)
        $template->setValue('{{RAZON_SOCIAL_R}}', 'Empresa Autorizada X');
        $template->setValue('{{NOMBRE_CENTRO_R}}', 'Planta Tratamiento');
        $template->setValue('{{DIRECCION_R}}', 'Polígono Industrial 123');
        $template->setValue('{{MUNICIPIO_R}}', 'Valencia');
        $template->setValue('{{CIF_R}}', 'B12345678');
        $template->setValue('{{C_POSTAL_R}}', '46001');
        $template->setValue('{{PROVINCIA_R}}', 'Valencia');
        $template->setValue('{{CONTACTO_R}}', 'Responsable Planta');
        $template->setValue('{{TELEFONO_R}}', '960000000');
        $template->setValue('{{EMAIL_R}}', 'planta@empresa.com');
        $template->setValue('{{NO_PYGR_R}}', '123/XYZ');
        $template->setValue('{{NIMA_R}}', '0300099999');

        // Ejemplo de destino autorizado (se puede parametrizar)
        $template->setValue('{{RAZON_SOCIAL_A}}', 'Empresa Destino Y');
        $template->setValue('{{NOMBRE_CENTRO_A}}', 'Central Y');
        $template->setValue('{{DIRECCION_A}}', 'Av. Principal 45');
        $template->setValue('{{MUNICIPIO_A}}', 'Madrid');
        $template->setValue('{{CIF_A}}', 'B87654321');
        $template->setValue('{{C_POSTAL_A}}', '28001');
        $template->setValue('{{PROVINCIA_A}}', 'Madrid');
        $template->setValue('{{CONTACTO_A}}', 'Encargado Recepción');
        $template->setValue('{{TELEFONO_A}}', '910000000');
        $template->setValue('{{EMAIL_A}}', 'recepcion@empresa.com');
        $template->setValue('{{NO_PYGR_A}}', '456/ABC');
        $template->setValue('{{NIMA_A}}', '2800088888');

        // Datos del residuo (ejemplo)
        $template->setValue('{{LER}}', '160605');
        $template->setValue('{{PESO}}', '1200'); // en kg

        // Guardar en storage
        $fileName = 'CT_' . $centro->id . '_' . now()->format('Ymd_His') . '.docx';
        $path = storage_path("app/public/{$fileName}");
        $template->saveAs($path);
        // Descargar y borrar después
        return response()->download($path)->deleteFileAfterSend(true);
    }

    public function destroy(Centro $centro)
    {
        $centro->delete();
        return redirect()->route('centros.index')->with('success', 'Centro eliminado.');
    }
}
