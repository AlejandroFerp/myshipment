<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ListaLer;

class ListaLerSeeder extends Seeder
{
    public function run()
    {
        $json = file_get_contents(database_path('data/lista_ler.json')); 
        $residuos = json_decode($json, true);
        foreach ($residuos as $residuo) {
            ListaLer::create([
                'codigo' => $residuo['codigo'],
                'descripcion' => $residuo['texto'],
            ]);
        }
    }
}
