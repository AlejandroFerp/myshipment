<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListaLer extends Model
{
    protected $table = 'lista_ler';
    protected $fillable = ['codigo', 'descripcion']; // Aunque no lo editemos, sirve para lectura
    public $timestamps = true;
    // Relación inversa opcional
    public function wastes()
    {
        return $this->hasMany(Waste::class, 'lista_ler_id');
    }
}
