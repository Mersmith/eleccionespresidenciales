<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categoria;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Encuesta>
 */
class EncuestaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $inicio = fake()->dateTimeBetween('-1 week', '+1 week');
        return [
            'titulo' => 'Elección ' . fake()->word(),
            'categoria_id' => Categoria::factory(),
            'fecha_inicio' => $inicio,
            'fecha_fin' => (clone $inicio)->modify('+3 days'),
            'activa' => true,
        ];
    }
}
