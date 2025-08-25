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
        Schema::create('hazas', function (Blueprint $table) {
            $table->string('idHaza', 15)->primary();
            $table->string('nHaza', 10)->nullable();
            $table->enum('partido', ['Manzanete', 'Bujar', 'Marmosilla', 'Algar', 'Cantarranas', 'Compradizas','El Águila','Las Corderas'])->nullable();
            $table->float('hectareas')->nullable();
            $table->float('rentaAnual')->nullable();
            $table->enum('uso', ['Cultivo', 'Arrendamiento', 'Venta', 'Militar'])->nullable();
            $table->string('localizacion', 50)->nullable();
            $table->string('caballerizas', 50)->nullable();
            $table->date('fechaInicio')->nullable();
            $table->date('fechaFin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hazas');
    }
};
