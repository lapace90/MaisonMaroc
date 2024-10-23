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
        Schema::table('menus', function (Blueprint $table) {
            $table->boolean('status')->default(false); // false = désactivé par défaut
        });

        Schema::table('activities', function (Blueprint $table) {
            $table->boolean('status')->default(false); // false = désactivé par défaut
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
