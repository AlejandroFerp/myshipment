<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ❗ Si existía el modelo anterior (product_id/key/value), lo eliminamos
        Schema::dropIfExists('product_attributes'); // antiguo diseño
        Schema::dropIfExists('attribute_product');  // por si existe algo previo

        // Catálogo de atributos disponibles (peso, color, etc.)
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();         // ej: peso, color, modelo
            $table->enum('type', ['string','decimal','integer']); // tipo de dato
            $table->timestamps();
        });

        // Pivot que relaciona producto <-> atributo con su valor
        Schema::create('attribute_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_attribute_id')->constrained()->onDelete('cascade');

            // Guardamos el valor como string (validado según "type")
            $table->string('value')->nullable();

            $table->timestamps();

            $table->unique(['product_id', 'product_attribute_id'], 'product_attr_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attribute_product');
        Schema::dropIfExists('product_attributes');
    }
};
