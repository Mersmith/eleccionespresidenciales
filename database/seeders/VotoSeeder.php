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
        $users = User::all();
        $encuestas = Encuesta::all();

        foreach ($users as $user) {
            foreach ($encuestas as $encuesta) {
                // 50% de probabilidad de votar
                if (rand(0, 1)) {
                    $candidato = $encuesta->candidatos()->inRandomOrder()->first();

                    if ($candidato) {
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
    }
}
