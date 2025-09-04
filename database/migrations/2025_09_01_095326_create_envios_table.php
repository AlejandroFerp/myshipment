<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();

            $table->string('internal_reference')->unique();
            $table->string('client');
            $table->decimal('fuel_cost', 10, 2)->nullable();
            $table->decimal('shipment_cost', 10, 2)->nullable();
            $table->dateTime('date_field')->nullable();
            $table->dateTime('arrival_date')->nullable();
            $table->foreignId('origin_address_id')->constrained('addresses')->onDelete('cascade')->nullable();
            $table->foreignId('destiny_address_id')->constrained('addresses')->onDelete('cascade')->nullable();
            $table->timestamps();
        });

        
    }
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};