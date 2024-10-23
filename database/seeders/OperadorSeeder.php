<?php

namespace Database\Seeders;

use App\Models\Operador;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class OperadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // OPERADOR ESTRELLA:
        $user = User::create([
            'name' => 'Kevin',
            'email' => 'Kevin@real.net',
            'password' => Hash::make('12345678'),
        ])->assignRole('operador');

        Operador::create([
            'nombres' => 'Kevin',
            'apellidos' => 'Quispe',
            'dni' => '99882277',
            'celular' => '924443444',
            'direccion' => 'jr Su casa',
            'user_id' => $user->id,
        ]);

        // Operador 2
        $user2 = User::create([
            'name' => 'Laura',
            'email' => 'laura@real.net',
            'password' => Hash::make('12345678'),
        ])->assignRole('operador');

        Operador::create([
            'nombres' => 'Laura',
            'apellidos' => 'Pérez',
            'dni' => '12345678',
            'celular' => '987654321',
            'direccion' => 'Av. Siempre Viva 742',
            'user_id' => $user2->id,
        ]);

        // Operador 3
        $user3 = User::create([
            'name' => 'Carlos',
            'email' => 'carlos@real.net',
            'password' => Hash::make('12345678'),
        ])->assignRole('operador');

        Operador::create([
            'nombres' => 'Carlos',
            'apellidos' => 'García',
            'dni' => '87654321',
            'celular' => '951753159',
            'direccion' => 'Calle Falsa 123',
            'user_id' => $user3->id,
        ]);

        // Operador 4
        $user4 = User::create([
            'name' => 'Ana',
            'email' => 'ana@real.net',
            'password' => Hash::make('12345678'),
        ])->assignRole('operador');

        Operador::create([
            'nombres' => 'Ana',
            'apellidos' => 'Martínez',
            'dni' => '65432109',
            'celular' => '789456123',
            'direccion' => 'Calle Luna 456',
            'user_id' => $user4->id,
        ]);

        // Operador 5
        $user5 = User::create([
            'name' => 'Luis',
            'email' => 'luis@real.net',
            'password' => Hash::make('12345678'),
        ])->assignRole('operador');

        Operador::create([
            'nombres' => 'Luis',
            'apellidos' => 'Sánchez',
            'dni' => '32109876',
            'celular' => '654987321',
            'direccion' => 'Pueblo Libre 789',
            'user_id' => $user5->id,
        ]);

        // Operador 6
        $user6 = User::create([
            'name' => 'María',
            'email' => 'maria@real.net',
            'password' => Hash::make('12345678'),
        ])->assignRole('operador');

        Operador::create([
            'nombres' => 'María',
            'apellidos' => 'Lopez',
            'dni' => '98765432',
            'celular' => '321654987',
            'direccion' => 'Calle Estrella 123',
            'user_id' => $user6->id,
        ]);

    }
}

