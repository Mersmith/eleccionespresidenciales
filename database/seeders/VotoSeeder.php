<?php

namespace Database\Seeders;

use App\Models\Encuesta;
use App\Models\User;
use App\Models\Voto;
use Illuminate\Database\Seeder;

class VotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuarios = User::all();
        $encuestas = Encuesta::all();

        foreach ($usuarios as $usuario) {
            // El usuario intentará votar en 2 encuestas aleatorias
            $encuestasAleatorias = $encuestas->random(rand(1, 2));

            foreach ($encuestasAleatorias as $encuesta) {
                // Obtener los candidatos relacionados con esta encuesta
                $candidatos = $encuesta->candidatos;

                if ($candidatos->isNotEmpty()) {
                    Voto::updateOrCreate(
                        [
                            'user_id' => $usuario->id,
                            'encuesta_id' => $encuesta->id,
                        ],
                        [
                            'candidato_id' => $candidatos->random()->id,
                            'fecha_voto' => now()->subDays(rand(0, 10)),
                        ]
                    );
                }
            }
        }
    }
}
