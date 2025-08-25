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
        Schema::create('juntaHazas', function (Blueprint $table) {
            $table->string('idJuntaHazas', 10)->primary();
            $table->string('nombre', 30)->nullable();
            $table->string('apellido1', 30)->nullable();
            $table->string('apellido2', 30)->nullable();
            $table->enum('tipoParticipante', ['alcalde', 'asociado', 'concejal'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juntaHazas');
    }
};
