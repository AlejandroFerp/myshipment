<?php

namespace App\Http\Controllers;
use App\Services\PdfService;
use App\Models\Cliente;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;
use PhpOffice\PhpWord\TemplateProcessor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\Direccion;
use App\Models\Waste;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }
    public function generarPdf($id, PdfService $pdfService)
    {
        $cliente = Cliente::with('direcciones')->findOrFail($id);
        $direccion = $cliente->direcciones->first(); // Tomamos la principal

        return $pdfService->generarClientePdf($cliente, $direccion);
    }
    //generar pdf a partir de plantilals de word puede que se quede obsoleto
    public function generatePdfWord(Cliente $cliente)
    {
        // Cargar plantilla
        $templatePath = storage_path('app/templates/cliente_template.docx');
        $templateProcessor = new TemplateProcessor($templatePath);

        // Rellenar datos
        $templateProcessor->setValue('NOMBRE', $cliente->nombre);
        $templateProcessor->setValue('CIF', $cliente->cif);
        $templateProcessor->setValue('EMAIL', $cliente->email ?? 'Sin email');
        $templateProcessor->setValue('TELEFONO', $cliente->telefono ?? 'Sin teléfono');

        // Guardar documento temporal
        $tempFile = tempnam(sys_get_temp_dir(), 'cliente_') . '.docx';
        $templateProcessor->saveAs($tempFile);

        // Convertir a PDF usando DomPDF
        $phpWord = \PhpOffice\PhpWord\IOFactory::load($tempFile);
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');

        $pdfFile = tempnam(sys_get_temp_dir(), 'cliente_') . '.pdf';
        $objWriter->save($pdfFile);

        return response()->download($pdfFile, 'cliente_'.$cliente->id.'.pdf')->deleteFileAfterSend(true);
    }
    public function create()
    {
        $paises = Countries::all()->pluck('name.common')->sort();
        $wastes = Waste::all();
        return view('clientes.create', compact('paises','wastes'));
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
        DB::transaction(function () use ($request){
        // Crear cliente
        $cliente = Cliente::create($request->only(['nombre','cif','email','telefono']));

        // Crear dirección asociada
        $direccion=$cliente->direcciones()->create($request->only([
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
            // 3. Guardar la dirección principal en el cliente
            $cliente->update(['direccion_id' => $direccion->id]);
        });
        //guardar los residuos
        if($request->filled('wastes'))
        {
            $cliente->wastes()->sync($request->wastes);
        }
        return redirect()->route('clientes.index')->with('success', 'Cliente creado con dirección');
    }


    public function edit(Cliente $cliente)
    {
        // Traer todas las direcciones asociadas al cliente
        $direcciones = $cliente->direcciones()->get();

        // Traer todos los residuos asociados al cliente
        $wastes = waste::with('lista_ler')->get();
        // Traer la dirección principal
        $direccionPrincipal = null;

        if ($cliente->direccion_id) {
            $direccionPrincipal = Direccion::find($cliente->direccion_id);

            // Si no está en la colección, la agregamos al principio
            if ($direccionPrincipal && !$direcciones->contains($direccionPrincipal)) {
                $direcciones->prepend($direccionPrincipal);
            }
        }
        $wastes = Waste::all();
        //Cargar relacion wastes del cliente
        $cliente->load('wastes');
        return view('clientes.edit', compact('cliente', 'direcciones','wastes'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre'=>'required|string|max:255',
            'cif'=>'required|string|max:255',
            'email'    => 'nullable|email',
            'telefono' => 'nullable|string|max:20',
            'direccion_id' => 'nullable|exists:direcciones,id',
        ]);
        $cliente->update($request->all());
        if($request->filled('wastes'))
        {
            $cliente->wastes()->sync($request->wastes);
        }
        else{
            $cliente->wastes()->sync([]);//limpia si no se escoge nada
        }
        return redirect()->route('clientes.index');
    }
    public function getResiduos(Cliente $cliente)
    {
        $residuos = $cliente->wastes()->get(['id','code','name']);
        return response()->json($residuos);
    }
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index');
    }
}
