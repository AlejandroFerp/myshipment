<?php

namespace App\Services;

use setasign\Fpdi\Fpdi;

class PdfService
{
    public function generarClientePdf($cliente, $direccion)
    {
        $pdf = new Fpdi();

        // Cargar plantilla PDF
        $pageCount = $pdf->setSourceFile(storage_path('app/plantillas/cliente_base.pdf'));
        $templateId = $pdf->importPage(1);

        $pdf->AddPage();
        $pdf->useTemplate($templateId);

        // Fuente
        $pdf->SetFont('Helvetica', '', 12);
        $pdf->SetTextColor(0, 0, 0);

        // Rellenar datos del cliente (X,Y en mm)
        $pdf->SetXY(50, 50);
        $pdf->Write(0, "Nombre: {$cliente->nombre}");

        $pdf->SetXY(50, 60);
        $pdf->Write(0, "CIF: {$cliente->cif}");

        $pdf->SetXY(50, 70);
        $pdf->Write(0, "Correo: {$cliente->email}");

        $pdf->SetXY(50, 80);
        $pdf->Write(0, "Teléfono: {$cliente->telefono}");

        // Rellenar datos de dirección
        $pdf->SetXY(50, 100);
        $pdf->Write(0, "Dirección: {$direccion->address_line_1} {$direccion->address_line_2}");

        $pdf->SetXY(50, 110);
        $pdf->Write(0, "Ciudad / Distrito: {$direccion->district_city}");
        $pdf->SetXY(50, 120);
        $pdf->Write(0, "Provincia: {$direccion->state_province}");
        $pdf->SetXY(50, 130);
        $pdf->Write(0, "Código Postal: {$direccion->postal_code}");
        $pdf->SetXY(50, 140);
        $pdf->Write(0, "País: {$direccion->country}");

        // Guardar o descargar
        $fileName = "cliente_{$cliente->id}.pdf";
        $pdf->Output('D', $fileName); // 'D' descarga directo
    }
}
