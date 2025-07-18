<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Candidato;
use App\Models\Encuesta;
use Illuminate\Support\Facades\DB;

class CandidatoEncuestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $candidatos = Candidato::all();
        $encuestas = Encuesta::all();

        // A cada encuesta le asignamos entre 2 y 5 candidatos aleatorios (sin repetir el mismo en la misma encuesta)
        foreach ($encuestas as $encuesta) {
            $candidatosRandom = $candidatos->random(rand(20, 30)); // elige entre 2 y 5 candidatos

            foreach ($candidatosRandom as $candidato) {
                DB::table('candidato_encuesta')->insert([
                    'candidato_id' => $candidato->id,
                    'encuesta_id' => $encuesta->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
