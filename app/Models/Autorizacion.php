<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autorizacion extends Model
{
    use HasFactory;
    protected $table = 'autorizaciones'; // <- esto fuerza a usar tu tabla real
    protected $fillable = ['nombre', 'codigo', 'descripcion'];
}
