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
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('customer_email'); // Email du client
            $table->date('check_in_date'); // Date de début du séjour
            $table->date('check_out_date'); // Date de fin du séjour
        });
    }
    
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['customer_email', 'check_in_date', 'check_out_date']);
        });
    }
    

};
