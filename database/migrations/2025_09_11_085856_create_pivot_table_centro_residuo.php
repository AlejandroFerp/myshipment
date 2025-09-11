<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('centro_residuo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('centro_id')->constrained('centros');
            $table->foreignId('waste_id')->constrained('wastes');
            $table->string('operacion_tratamiento')->nullable();
            $table->string('peligrosidad')->nullable(); // HP codes
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_table_centro_residuo');
    }
};
