<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombres' => $this->faker->name,
            'apellidos' => $this->faker->lastname,
            'dni' => $this->faker->unique()->numerify('########'), // 8 dígitos únicos
            'placa' => $this->faker->unique()->bothify('???-###'),
            'correo' => $this->faker->unique()->safeEmail,
            'celular' => $this->faker->phoneNumber,
            'direccion' => $this->faker->address,
        ];
    }
}
