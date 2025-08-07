<?php

namespace Database\Seeders;

use App\Models\Auspiciador;
use App\Models\Candidato;
use App\Models\Membresia;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class MembresiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $candidatos = Candidato::all();
        $auspiciadores = Auspiciador::all();

        $startDate = Carbon::create(2023, 8, 1);
        $endDate = Carbon::create(2025, 8, 1);

        $allMonths = [];

        while ($startDate <= $endDate) {
            $allMonths[] = $startDate->copy();
            $startDate->addMonth();
        }

        foreach ($allMonths as $mes) {
            foreach ($candidatos as $candidato) {
                if ($faker->boolean(60)) {
                    Membresia::create([
                        'candidato_id' => $candidato->id,
                        'auspiciador_id' => null,
                        'mes' => $mes->format('Y-m-d'),
                        'pagado' => $faker->boolean(80),
                        'plan_id' => $candidato->plan_id,
                        'precio_pagado' => $faker->randomFloat(2, 20, 150),
                    ]);
                }
            }

            foreach ($auspiciadores as $auspiciador) {
                if ($faker->boolean(50)) {
                    Membresia::create([
                        'candidato_id' => null,
                        'auspiciador_id' => $auspiciador->id,
                        'mes' => $mes->format('Y-m-d'),
                        'pagado' => $faker->boolean(75),
                        'plan_id' => $auspiciador->plan_id,
                        'precio_pagado' => $faker->randomFloat(2, 50, 300),
                    ]);
                }
            }
        }
    }
}
