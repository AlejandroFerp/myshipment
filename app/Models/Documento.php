<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;
    protected $fillable = ['envio_id','tipo','ruta_archivo'];

    public function envio()
    {
        return $this->belongsTo(Envio::class);
    }
}
