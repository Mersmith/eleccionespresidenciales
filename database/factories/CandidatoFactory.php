<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Encuesta;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidato>
 */
class CandidatoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name,
            'descripcion' => $this->faker->paragraph,
            'foto' => $this->faker->imageUrl(300, 300, 'people', true, 'candidato'), // URL de imagen aleatoria
        ];
    }
}
