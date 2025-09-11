<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Centro extends Model
{
    protected $table = 'centros';

    protected $fillable = [
        'cliente_id',
        'direccion_id',
        'nombre_comercial',
        'nima',
        'tarifa',
        'nombre_contacto',
        'telefono',
        'email',
        'detalle_envio',
    ];

    /**
     * Relación con Cliente
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Relación con Dirección
     */
    public function direccion(): BelongsTo
    {
        return $this->belongsTo(Direccion::class);
    }
    public function wastes() {
        return $this->belongsToMany(Waste::class, 'centro_residuo')
                    ->withPivot(['operacion_tratamiento','peligrosidad','observaciones'])
                    ->withTimestamps();
    }
}
