<?php

namespace Database\Seeders;

use App\Models\Candidato;
use App\Models\Partido;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CandidatoCargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $encuestas = [
            [
                'cargo_id' => 1,
                'region_id' => null,
                'provincia_id' => null,
                'distrito_id' => null,
            ],
            [
                'cargo_id' => 3,
                'region_id' => 14,
                'provincia_id' => null,
                'distrito_id' => null,
            ],
            [
                'cargo_id' => 3,
                'region_id' => 14,
                'provincia_id' => null,
                'distrito_id' => null,
            ],
            [
                'cargo_id' => 6,
                'region_id' => 14,
                'provincia_id' => 135,
                'distrito_id' => null,
            ],
            [
                'cargo_id' => 7,
                'region_id' => 14,
                'provincia_id' => 135,
                'distrito_id' => 1369,
            ],
        ];

        $candidatos = Candidato::all();
        $partidos = Partido::all();

        foreach ($encuestas as $encuesta) {
            foreach ($candidatos->random(3) as $candidato) {
                DB::table('candidato_cargo')->insert([
                    'candidato_id' => $candidato->id,
                    'cargo_id' => $encuesta['cargo_id'],
                    'eleccion_id' => is_null($encuesta['region_id']) && is_null($encuesta['provincia_id']) && is_null($encuesta['distrito_id']) ? 1 : 2,
                    'partido_id' => $partidos->random()->id,
                    'region_id' => $encuesta['region_id'],
                    'provincia_id' => $encuesta['provincia_id'],
                    'distrito_id' => $encuesta['distrito_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
