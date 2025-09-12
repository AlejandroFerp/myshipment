<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Waste;
use App\Models\ListaLer;

class WastesSeeder extends Seeder
{
    public function run(): void
    {
        $ler1 = ListaLer::first(); // ejemplo: toma el primer código LER

        Waste::create([
            'internal_code' => 160605,
            'lista_ler_id' => $ler1->id,
            'descripcion_libre' => 'Baterías de litio'
        ]);

        Waste::create([
            'internal_code' => 160606,
            'lista_ler_id' => $ler1->id,
            'descripcion_libre' => 'Aceites usados'
        ]);
    }
}
