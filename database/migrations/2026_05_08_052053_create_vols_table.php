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
    Schema::create('vols', function (Blueprint $table) {
        $table->id();
        $table->string('numero_vol');
        $table->string('origine');
        $table->string('destination');
        $table->dateTime('date_depart');
        $table->dateTime('date_arrivee');
        $table->decimal('prix', 8, 2);
        $table->integer('places_disponibles');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vols');
    }
};
