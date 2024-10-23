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
    Schema::create('drafts', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // Associer le brouillon à un utilisateur
        $table->string('name');
        $table->text('description')->nullable();
        $table->decimal('price', 8, 2)->nullable();
        $table->string('duration')->nullable();
        $table->string('image')->nullable();
        $table->string('photo')->nullable();
        $table->string('type'); // (activity/menu)
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Assurer l'intégrité référentielle
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drafts');
    }
};
