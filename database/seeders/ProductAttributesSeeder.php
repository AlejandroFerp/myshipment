<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;

class ProductAttributesSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'peso',     'type' => 'decimal'],
            ['name' => 'color',    'type' => 'string'],
            ['name' => 'ubicacion','type' => 'string'],
            ['name' => 'modelo',   'type' => 'string'],
            ['name' => 'marca',    'type' => 'string'],
        ];

        foreach ($data as $row) {
            ProductAttribute::firstOrCreate(['name' => $row['name']], $row);
        }
    }
}
