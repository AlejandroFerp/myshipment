<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('environmental_authorizations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('autorizacion_id')->constrained('autorizaciones')->onDelete('cascade'); // relación
            $table->foreignId('center_id')->constrained('centros')->onDelete('cascade');
            $table->string('code')->unique();
            $table->foreignId('autonomic_community_id')->constrained('autonomic_communities')->onDelete('cascade');
            // $table->foreignId('type_of_authorization_id')->constrained('type_of_authorizations')->onDelete('cascade');
            $table->foreignId('waste_id')->constrained('wastes')->onDelete('cascade');
            $table->string('lers')->nullable();

            $table->string('pdf')->nullable(); // ruta del PDF subido

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('environmental_authorizations');
    }
};
