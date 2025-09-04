<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'internal_reference',
        'client',
        'carrier_id',
        'fuel_cost',
        'shipment_cost',
        'date_field',
        'arrival_date',
        'origin_address_id',
        'destiny_address_id',
    ];

    // Relación 1:N con Packages
    public function packages()
    {
        return $this->hasMany(Package::class);
    }

      public function direcciones()
    {
        return $this->morphMany(Direccion::class, 'direccionable');
    }
}
