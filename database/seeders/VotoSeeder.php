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
        foreach (User::all() as $user) {
            // Elegimos una encuesta aleatoria
            $encuesta = Encuesta::inRandomOrder()->first();

            // Buscamos los candidatos relacionados a esa encuesta
            $candidatos = $encuesta->candidatos;

            // Si hay candidatos disponibles para esa encuesta
            if ($candidatos->isNotEmpty()) {
                // Elegimos un candidato aleatoriamente
                $candidato = $candidatos->random();

                // Creamos el voto
                Voto::create([
                    'user_id' => $user->id,
                    'encuesta_id' => $encuesta->id,
                    'candidato_id' => $candidato->id,
                    'fecha_voto' => now(),
                ]);
            }
        }
    }
}
