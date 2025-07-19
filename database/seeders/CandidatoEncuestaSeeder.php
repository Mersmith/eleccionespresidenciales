<?php

namespace Database\Seeders;

use App\Models\Candidato;
use App\Models\Encuesta;
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

        // Solo candidatos que tengan al menos un cargo asignado
        $candidatosConCargo = Candidato::has('cargos')->get(); // asumiendo relación cargos()

        foreach ($candidatosConCargo as $candidato) {
            // Puedes decidir cuántas encuestas le asignas a cada candidato
            $encuestasAleatorias = $encuestas->random(rand(1, min(2, $encuestas->count())));

            foreach ($encuestasAleatorias as $encuesta) {
                // Verificamos que no esté duplicado
                CandidatoEncuesta::firstOrCreate([
                    'candidato_id' => $candidato->id,
                    'encuesta_id' => $encuesta->id,
                ]);
            }
        }
    }
}
