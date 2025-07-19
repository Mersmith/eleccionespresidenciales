<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Eleccion>
 */
class EleccionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->randomElement(['Elección Presidencial 2026', 'Elección Municipal 2026']),
            'tipo' => $this->faker->randomElement(['presidencial', 'municipal']),
            'fecha' => $this->faker->date(),
        ];
    }
}
