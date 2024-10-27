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
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom du type de chambre (ex: "Suite", "Tente", etc.)
            $table->decimal('adult_rate', 8, 2); // Tarif pour adulte
            $table->decimal('child_rate', 8, 2); // Tarif pour enfant
            $table->decimal('price', 8, 2); // Assure-toi que cette ligne est présente
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};
