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
    Schema::create('reservations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('vol_id')->constrained('vols')->onDelete('cascade');
        $table->foreignId('vol_retour_id')->nullable()->constrained('vols')->onDelete('cascade');
        $table->enum('type_voyage', ['aller_simple', 'aller_retour']);
        $table->dateTime('date_reservation');
        $table->enum('statut', ['confirmé', 'annulé'])->default('confirmé');
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
