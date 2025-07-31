<?php

namespace Database\Seeders;

use App\Models\Encuesta;
use App\Models\CandidatoEncuesta;
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
        // Obtener todos los usuarios
        $usuarios = User::all();

        // Obtener encuestas presidenciales (IDs del 1 al 24)
        $encuestas = Encuesta::whereIn('id', range(1, 24))->get();

        foreach ($usuarios as $usuario) {
            foreach ($encuestas as $encuesta) {

                // Obtener todos los candidatos válidos para esta encuesta
                $candidatos = CandidatoEncuesta::where('encuesta_id', $encuesta->id)->pluck('candidato_cargo_id');

                if ($candidatos->isEmpty()) {
                    continue;
                }

                // Elegir un candidato al azar para votar
                $candidatoCargoId = $candidatos->random();

                // Insertar el voto solo si no existe
                Voto::firstOrCreate([
                    'user_id' => $usuario->id,
                    'encuesta_id' => $encuesta->id,
                ], [
                    'candidato_cargo_id' => $candidatoCargoId,
                    'fecha_voto' => now(),
                ]);
            }
        }
    }
}
