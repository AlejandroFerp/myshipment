<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = 'direcciones';

    protected $fillable = [
        'name',
        'description',
        'address_line_1',
        'address_line_2',
        'district_city',
        'state_province',
        'postal_code',
        'country',
        'latitude',
        'longitude',
    ];
}
