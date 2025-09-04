<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','cif','email','telefono','direccion'];

    public function shipments()
    {
        return $this->hasMany(Envio::class);
    }
}
