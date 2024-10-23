<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Operador;
use App\Models\Tarifa;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {    

        $this->call([RoleSeeder::class,]);

        //
        User::create([
            'name'=>'admin',
            'email' => 'admin@real.net',
            'password'=>Hash::make('12345678'),
            ])->assignRole('admin');

            $this->call([
                OperadorSeeder::class,
                ClienteSeeder::class,
                ParqueoSeeder::class,
                TarifaSeeder::class,
            ]);

    }
}
