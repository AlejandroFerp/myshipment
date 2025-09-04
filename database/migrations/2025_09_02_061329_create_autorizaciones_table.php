<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('autorizaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();   // obligatorio y único
            $table->string('codigo')->unique();   // obligatorio y único
            $table->text('descripcion')->nullable(); // opcional
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('autorizaciones');
    }
};
