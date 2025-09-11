<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waste extends Model
{
    use HasFactory;

    protected $table = 'wastes';

    protected $fillable = ['lista_ler_id', 'code', 'name', 'description'];
    //relaciones
    // Un waste pertenece a un código LER
    public function ler() {
        return $this->belongsTo(ListaLer::class, 'lista_ler_id');
    }
    // Un waste puede estar asociado a muchos centros
    public function centros() {
        return $this->belongsToMany(Centro::class, 'centro_residuo')
                        ->withPivot(['operacion_tratamiento','peligrosidad','observaciones'])
                        ->withTimestamps();
    }
}

   