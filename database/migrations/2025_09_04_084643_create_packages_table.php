<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id('id_package'); // PK
            $table->string('reference')->unique(); // Match Reference
            $table->foreignId('shipment_id')->constrained('shipments')->onDelete('cascade'); // FK → Shipments
            $table->enum('type_cargo', ['Pallet','Paletina','Package']);
            $table->decimal('weight_kg', 10, 2)->nullable();
            $table->decimal('units', 10, 2)->nullable();
            $table->decimal('volume_cubic', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->decimal('cost', 10, 2)->nullable();
            $table->decimal('unitary_cost', 10, 2)->virtualAs('cost / units'); // calculado en DB si soporta
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
