<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Direccion extends Model
{
    use HasFactory;
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
        'longitude'
    ];

    public function direccionable()
    {
        return $this->morphTo();
    }
}
