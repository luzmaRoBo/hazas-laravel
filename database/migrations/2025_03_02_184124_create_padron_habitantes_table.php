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
        Schema::create('padronHabitantes', function (Blueprint $table) {
            $table->string('idHabitante', 10)->primary();
            $table->string('apellido1', 120)->nullable();
            $table->string('apellido2', 120)->nullable();
            $table->string('nombre', 120)->nullable();
            $table->string('domicilioOriginal', 120)->nullable();
            $table->enum('tipoDireccion', ['calle', 'avenida', 'plaza', 'carretera', 'camino', 'callejon'])->nullable();
            $table->string('nombreDireccion', 120)->nullable();
            $table->string('numeroDireccion', 5)->nullable();
            $table->string('bloqueDireccion', 5)->nullable();
            $table->string('escaleraDireccion', 5)->nullable();
            $table->string('piso', 5)->nullable();
            $table->string('puerta', 5)->nullable();
            $table->string('codigoPostal', 5)->nullable();
            $table->boolean('excluido')->default(0);
            $table->date('fechaExclusion')->nullable();
            $table->text('observaciones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('padronHabitantes');
    }
};
