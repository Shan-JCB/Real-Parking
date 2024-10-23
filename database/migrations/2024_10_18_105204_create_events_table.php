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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

                    // Relación con la tabla de clientes
            $table->string('placa');
            $table->foreign('placa')->references('placa')->on('clientes')->onDelete('cascade');

            // Relación con la tabla de parqueos
            $table->unsignedBigInteger('parqueo_id');
            $table->foreign('parqueo_id')->references('id')->on('parqueos')->onDelete('cascade');

            // Relación con la tabla de operadores
            $table->unsignedBigInteger('operador_id');
            $table->foreign('operador_id')->references('id')->on('operadors')->onDelete('cascade');

            // Nuevo campo proceso
            $table->enum('proceso', ['En curso', 'Finalizado'])->default('En curso');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
