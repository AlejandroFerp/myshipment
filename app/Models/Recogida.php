<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recogida extends Model
{
    use HasFactory;
    protected $fillable = ['envio_id','fecha_recogida','observaciones'];

    public function envio()
    {
        return $this->belongsTo(Envio::class);
    }
}
