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
        Schema::table('canchas', function (Blueprint $table) {
            $table->boolean('tiene_luz_led')->default(false);
            $table->boolean('tiene_vestuarios')->default(false);
            $table->boolean('tiene_estacionamiento')->default(false);
            $table->enum('tipo_cesped', ['sintetico', 'real'])->default('sintetico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('canchas', function (Blueprint $table) {
            $table->dropColumn(['tiene_luz_led', 'tiene_vestuarios', 'tiene_estacionamiento', 'tipo_cesped']);
        });
    }
};
