<?php

namespace Database\Seeders;

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
        // Paso 1: obtener todos los candidato_cargo_id de los candidato_id entre 1 y 25
        $candidatoCargosPresidencial = CandidatoCargo::whereIn('candidato_id', range(1, 25))->get();

        // Paso 2: Iterar sobre las encuestas del 1 al 24
        foreach (range(1, 24) as $encuestaId) {
            foreach ($candidatoCargosPresidencial as $candidatoCargo) {
                // Verifica que no exista para evitar duplicados
                CandidatoEncuesta::firstOrCreate([
                    'candidato_cargo_id' => $candidatoCargo->id,
                    'encuesta_id' => $encuestaId,
                ]);
            }
        }

        // Obtener los candidato_cargo_id para candidatos 26 al 33
        $candidatoCargosAlcaldiaLima = CandidatoCargo::whereIn('candidato_id', range(26, 33))->get();

        // Recorrer encuestas 37 al 44
        foreach (range(37, 44) as $encuestaId) {
            foreach ($candidatoCargosAlcaldiaLima as $candidatoCargo) {
                CandidatoEncuesta::firstOrCreate([
                    'candidato_cargo_id' => $candidatoCargo->id,
                    'encuesta_id' => $encuestaId,
                ]);
            }
        }
    }
}
