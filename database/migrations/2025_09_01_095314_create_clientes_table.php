<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('cif')->unique(); // 🚀 obligatorio y único
        $table->string('email')->nullable();
        $table->string('telefono')->nullable();
        // Relación con direcciones
        $table->unsignedBigInteger('direccion_id')->nullable();
        $table->foreign('direccion_id')->references('id')->on('direcciones')->onDelete('set null');
        $table->timestamps();
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};


