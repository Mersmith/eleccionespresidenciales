<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Encuesta;
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
        $encuestas = Encuesta::with('candidatoCargos')->get(); // asumimos que esta relación existe

        foreach ($usuarios as $usuario) {
            // El usuario vota en 1 o 2 encuestas aleatorias
            $encuestasAleatorias = $encuestas->random(rand(1, min(2, $encuestas->count())));

            foreach ($encuestasAleatorias as $encuesta) {
                // Suponemos que la relación en Encuesta es llamada candidatosCargo
                $candidatoCargos = $encuesta->candidatoCargos;

                if ($candidatoCargos->isNotEmpty()) {
                    Voto::updateOrCreate(
                        [
                            'user_id' => $usuario->id,
                            'encuesta_id' => $encuesta->id,
                        ],
                        [
                            'candidato_cargo_id' => $candidatoCargos->random()->id,
                            'fecha_voto' => now()->subDays(rand(0, 10)),
                        ]
                    );
                }
            }
        }
    }
}
