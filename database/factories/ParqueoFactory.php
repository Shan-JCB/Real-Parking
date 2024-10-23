<?php

namespace Database\Factories;

use App\Models\Parqueo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParqueoFactory extends Factory
{
    protected $model = Parqueo::class;

    public function definition()
    {
        return [
            'estado' => 'LIBRE',
            'observacion' => $this->faker->optional()->sentence(),
        ];
    }
}
