<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_package';
    protected $fillable = [
        'reference',
        'shipment_id',
        'type_cargo',
        'weight_kg',
        'units',
        'volume_cubic',
        'description',
        'cost',
        'unitary_cost',
        'auto_number',
    ];

    // Relación con Shipment
    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }
}
