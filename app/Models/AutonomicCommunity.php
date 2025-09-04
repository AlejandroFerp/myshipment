<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutonomicCommunity extends Model
{
    use HasFactory;

    protected $table = 'autonomic_communities';

    protected $fillable = [
        'name',
        'code',
        'address_id'
    ];

    // Relación con la dirección
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
