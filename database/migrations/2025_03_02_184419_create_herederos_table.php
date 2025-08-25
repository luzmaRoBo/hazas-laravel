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
        Schema::create('herederos', function (Blueprint $table) {
            $table->string('idHeredero', 10)->primary();
            $table->string('idHabitante', 10)->nullable();
            $table->integer('orden')->nullable();
            $table->string('apellido1', 50)->nullable();
            $table->string('apellido2', 50)->nullable();
            $table->string('nombre', 50)->nullable();
            $table->enum('tipoDireccion', ['calle', 'avenida', 'plaza', 'carretera', 'camino', 'callejon'])->nullable();
            $table->string('nombreDireccion', 50)->nullable();
            $table->string('numeroDireccion', 50)->nullable();
            $table->string('bloqueDireccion', 50)->nullable();
            $table->string('escaleraDireccion', 50)->nullable();
            $table->string('piso', 50)->nullable();
            $table->string('puerta', 50)->nullable();
            $table->string('codigoPostal', 50)->nullable();
            $table->string('telefono', 10)->nullable();
            $table->string('email', 30)->nullable();
            $table->foreign('idHabitante')->references('idHabitante')->on('padronHabitantes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('herederos');
    }
};
