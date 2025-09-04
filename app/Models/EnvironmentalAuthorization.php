<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvironmentalAuthorization extends Model
{
    use HasFactory;
    protected $table = 'environmental_authorizations'; // <- esto fuerza a usar tu tabla real
    protected $fillable = [
        'autorizacion_id',
        'center_id',
        'code',
        'autonomic_community_id',
        'type_of_authorization_id',
        'waste_id',
        'lers',
        'pdf'
    ];

    // Relaciones
    public function autorizacion()
    {
        return $this->belongsTo(Autorizacion::class);
    }

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function autonomicCommunity()
    {
        return $this->belongsTo(AutonomicCommunity::class);
    }

    public function typeOfAuthorization()
    {
        return $this->belongsTo(TypeOfAuthorization::class);
    }

    public function waste()
    {
        return $this->belongsTo(Waste::class);
    }
}
