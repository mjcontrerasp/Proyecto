<?php

namespace Database\Factories;

use App\Models\Donacion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonacionFactory extends Factory
{
    protected $model = Donacion::class;

    public function definition()
    {
        return [
            'id_usuario' => User::factory(),
            'tipo_comida' => $this->faker->word(),
            'cantidad' => $this->faker->numberBetween(1, 50),
            'fecha_hora' => now(),
            'punto_recogida' => $this->faker->address(),
            'estado' => 'No asignada',
        ];
    }
}
