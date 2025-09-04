<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'cif', 'email', 'telefono'];

    public function direcciones()
    {
        return $this->morphMany(Direccion::class, 'direccionable');
    }
}
