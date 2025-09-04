<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('autonomic_communities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->foreignId('address_id')->nullable()->constrained('addresses')->onDelete('set null'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('autonomic_communities');
    }
};
