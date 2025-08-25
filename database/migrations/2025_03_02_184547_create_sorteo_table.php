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
        Schema::create('sorteo', function (Blueprint $table) {
            $table->string('idSorteo', 10)->primary();
            $table->string('idHabitante', 10)->nullable();
            $table->string('idHaza', 15)->nullable();
            $table->date('fecha')->nullable();
            $table->foreign('idHabitante')->references('idHabitante')->on('padronHabitantes')->onDelete('cascade');
            $table->foreign('idHaza')->references('idHaza')->on('hazas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sorteo');
    }
};
