<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'type','name','description','price','sku','stock','waste_id',
    ];

    public function waste()
    {
        return $this->belongsTo(Waste::class);
    }

    // Catálogo de atributos con valor en pivot
    public function attributes()
    {
        return $this->belongsToMany(ProductAttribute::class, 'attribute_product')
                    ->withPivot('value')
                    ->withTimestamps();
    }

    // Scopes (opcional)
    public function scopeServices($q){ return $q->where('type','service'); }
    public function scopeItems($q){ return $q->where('type','item'); }
    public function scopeWastes($q){ return $q->where('type','waste'); }
}
