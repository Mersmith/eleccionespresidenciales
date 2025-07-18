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
       
        $fechaInicio = $this->faker->dateTimeBetween('-1 month', 'now');
        $fechaFin = (clone $fechaInicio)->modify('+7 days');

        return [
            'titulo' => $this->faker->sentence(4),
            'categoria_id' => Categoria::factory(), // relaciona con una categoría
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'activa' => $this->faker->boolean(80), // 80% de probabilidad de ser true
        ];
    }
}
