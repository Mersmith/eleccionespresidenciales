<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Encuesta;
use App\Models\Candidato;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voto>
 */
class VotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $encuesta = Encuesta::inRandomOrder()->first() ?? Encuesta::factory()->create();
        $candidato = Candidato::where('encuesta_id', $encuesta->id)->inRandomOrder()->first() ?? Candidato::factory()->create(['encuesta_id' => $encuesta->id]);
        $user = User::inRandomOrder()->first() ?? User::factory()->create();

        return [
            'user_id' => $user->id,
            'encuesta_id' => $encuesta->id,
            'candidato_id' => $candidato->id,
            'fecha_voto' => now(),
        ];
    }
}
