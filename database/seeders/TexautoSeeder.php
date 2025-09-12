<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Direccion;
use App\Models\Centro;

class TexautoSeeder extends Seeder
{
    public function run(): void
    {
        // 1️⃣ Crear Cliente
        $cliente = Cliente::updateOrCreate([
            'nombre' => 'TEXAUTO MOTOR, S.L.',
            'cif' => 'B16735805',
            'email' => 'administracion@texauto.es',
            'telefono' => '661903300',
        ]);

        // 2️⃣ Crear Dirección principal
        $direccion = $cliente->direcciones()->updateOrCreate([
            'address_line_1' => 'Roses, 64',
            'postal_code' => '17600',
            'district_city' => 'Figueres',
            'state_province' => 'Girona',
            'country' => 'España',
        ]);

        // Guardar dirección principal en el cliente
        $cliente->update(['direccion_id' => $direccion->id]);

        // 3️⃣ Crear Centro asociado
        $centro = Centro::updateOrCreate([
            'cliente_id' => $cliente->id,
            'direccion_id' => $direccion->id,
            'nombre_comercial' => 'TEXAUTO MOTOR, S.L.',
            'nima' => '1700166575',
            'tarifa' => 0, // si no tienes tarifa, puede ser 0
            'nombre_contacto' => 'Administración',
            'telefono' => '661903300',
            'email' => 'administracion@texauto.es',
            'detalle_envio' => 'Número de inscripción: P-82166.2, Tipo de centro: productor P02, Actividad económica: comercio',
        ]);

        // 4️⃣ (Opcional) asignar residuos si ya tienes wastes en la DB
        // $centro->wastes()->attach([1,2]); // ids de residuos que quieras asignar
    }
}
