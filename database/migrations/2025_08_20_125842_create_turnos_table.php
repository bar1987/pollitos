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
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();
                        // Campo para la fecha y hora del turno
            $table->dateTime('start_datetime');

            // Relaciones
            $table->unsignedBigInteger('cancha_id');
            $table->unsignedBigInteger('client_id');

            // Claves foráneas
            $table->foreign('cancha_id')->references('id')->on('canchas')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turnos');
    }
};
