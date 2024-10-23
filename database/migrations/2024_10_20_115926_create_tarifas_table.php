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
        Schema::create('tarifas', function (Blueprint $table) {

            $table->id();
            $table->string('nombre');
            $table->decimal('monto', 8, 2); // Monto de la tarifa
            $table->decimal('periodo', 8, 2); // Periodo de tiempo
            $table->string('descripcion')->nullable(); // Descripción de la tarifa
            $table->timestamps();
        });

        // Agregar la relación con la tabla de pagos
        Schema::table('pagos', function (Blueprint $table) {
            $table->unsignedBigInteger('tarifa_id')->nullable(); // ID de la tarifa
            $table->foreign('tarifa_id')->references('id')->on('tarifas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->dropForeign(['tarifa_id']);
            $table->dropColumn('tarifa_id');
        });

        Schema::dropIfExists('tarifas');
    }
};
