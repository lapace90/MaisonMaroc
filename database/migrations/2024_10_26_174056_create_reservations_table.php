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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->dateTime('reservation_date');
            $table->date('check_in_date'); // Date de début du séjour
            $table->date('check_out_date'); // Date de fin du séjour
            $table->integer('number_of_people');
            $table->decimal('amount', 8, 2); // Montant de la réservation
            $table->string('payment_status')->default('pending'); // Statut du paiement
            $table->boolean('invoice_sent')->default(false); // Statut de la facture
            $table->dateTime('payment_date')->nullable(); // Date de paiement
            $table->text('notes')->nullable(); // Notes sur la réservation
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
