<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wastes', function (Blueprint $table) {
            $table->id();
            $table->integer('internal_code')->unique();
            // 👇 relación con lista_ler
            $table->foreignId('lista_ler_id')
                  ->constrained('lista_ler') // apunta a id de lista_ler
                  ->cascadeOnDelete();
            $table->string('descripcion_libre')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wastes');
    }
};
