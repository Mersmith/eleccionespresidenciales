<?php

namespace Database\Seeders;

use App\Models\Encuesta;
use App\Models\CandidatoCargo;
use App\Models\CandidatoEncuesta;
use Illuminate\Database\Seeder;

class CandidatoEncuestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $encuestas = Encuesta::all();

        $postulaciones = CandidatoCargo::all();

        foreach ($postulaciones as $postulacion) {
            $encuestasAleatorias = $encuestas->random(rand(1, min(2, $encuestas->count())));

            foreach ($encuestasAleatorias as $encuesta) {
                CandidatoEncuesta::firstOrCreate([
                    'candidato_cargo_id' => $postulacion->id,
                    'encuesta_id' => $encuesta->id,
                ]);
            }
        }
    }
}
