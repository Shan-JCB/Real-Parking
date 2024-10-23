<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tarifa;

class TarifaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear tarifas predeterminadas
        Tarifa::create([
            'nombre' => 'Tarifa Básica',
            'monto' => 5.00,
            'periodo' => 60.00, // 1 hora
            'descripcion' => 'Tarifa básica por hora',
        ]);

        Tarifa::create([
            'nombre' => 'Tarifa Nocturna',
            'monto' => 3.50,
            'periodo' => 120.00, // 2 horas
            'descripcion' => 'Tarifa especial para horario nocturno',
        ]);

        Tarifa::create([
            'nombre' => 'Tarifa Fin de Semana',
            'monto' => 6.00,
            'periodo' => 90.00, // 1.5 horas
            'descripcion' => 'Tarifa especial para los fines de semana',
        ]);

        Tarifa::create([
            'nombre' => 'Tarifa Día Completo',
            'monto' => 20.00,
            'periodo' => 1440.00, // 24 horas
            'descripcion' => 'Tarifa por todo el día',
        ]);
    }
}
