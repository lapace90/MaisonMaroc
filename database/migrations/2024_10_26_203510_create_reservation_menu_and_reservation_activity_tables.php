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
        // Table pivot pour les menus réservés dans une réservation
        Schema::create('reservation_menu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade');
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1); // Nombre de menus réservés
            $table->timestamps();
        });
    
        // Table pivot pour les activités réservées dans une réservation
        Schema::create('reservation_activity', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade');
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1); // Nombre d’activités réservées
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('reservation_menu');
        Schema::dropIfExists('reservation_activity');
    }
};
