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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();

            // Relación con el evento
            $table->unsignedBigInteger('evento_id');
            $table->foreign('evento_id')->references('id')->on('events')->onDelete('cascade');

            // Tiempo total de ocupación en minutos
            $table->decimal('tiempo_ocupacion', 8, 2);

            // Tarifa calculada según el tiempo de ocupación
            $table->decimal('tarifa', 8, 2);

            // Total a pagar
            $table->decimal('total', 8, 2);

            // Fecha y hora del pago
            $table->timestamp('fecha_pago')->useCurrent();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
