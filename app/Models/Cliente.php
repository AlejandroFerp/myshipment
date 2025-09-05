<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'cif', 'email', 'telefono','direccion_id'];

    public function direcciones()
    {
        return $this->morphMany(Direccion::class, 'direccionable');
    }
    // Dirección principal (FK)
    public function direccionPrincipal()
    {
        return $this->belongsTo(Direccion::class, 'direccion_id');
    }
}
