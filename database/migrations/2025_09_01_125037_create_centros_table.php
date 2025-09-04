<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('centros', function (Blueprint $table) {
            $table->id();

            // Relación con clientes
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');

            // Relación con direcciones
            $table->unsignedBigInteger('direccion_id')->nullable();
            $table->foreign('direccion_id')->references('id')->on('direcciones')->onDelete('set null');

            // Datos generales
            $table->string('nombre_comercial')->nullable();
            $table->string('nima')->nullable();
            $table->string('tarifa')->default('Base');

            // Contacto
            $table->string('nombre_contacto')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();

            // Detalles adicionales
            $table->text('detalle_envio')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centros');
    }
};
