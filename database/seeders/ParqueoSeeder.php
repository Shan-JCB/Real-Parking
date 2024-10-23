<?php

namespace Database\Seeders;

use App\Models\Parqueo;
use Illuminate\Database\Seeder;

class ParqueoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['PISO 1', 'PISO 2', 'PISO 3', 'PISO EXTERIOR'] as $piso) {
            for ($i = 1; $i <= 30; $i++) {
                Parqueo::create([
                    'numero' => $i, // Número secuencial
                    'estado' => 'LIBRE',
                    'piso' => $piso,
                    'observacion' => null, // Observación vacía
                ]);
            }
        }
    }
}
