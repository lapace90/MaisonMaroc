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
        Schema::table('reservations', function (Blueprint $table) {
            $table->integer('number_of_adults')->after('room_type_id')->default(0);
            $table->integer('number_of_children')->after('number_of_adults')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['number_of_adults', 'number_of_children']);
        });
    }
    
};
