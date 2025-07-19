<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cargo>
 */
class CargoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->randomElement([
                'Presidente', 'Diputado', 'Senador', 'Parlamento Andino',
                'Gobernador Regional', 'Alcalde Provincial', 'Alcalde Distrital'
            ]),
            'nivel' => $this->faker->randomElement(['nacional', 'regional', 'provincial', 'distrital']),
        ];
    }
}
