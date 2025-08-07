<?php

namespace Database\Seeders;

use App\Models\Auspiciador;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AuspiciadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Auspiciador::create([
                'nombre' => $faker->name,
                'empresa' => $faker->company,
                'celular' => $faker->phoneNumber,
                'observacion' => $faker->sentence,
                'plan_id' => rand(4, 7), // Asegúrate de tener planes con IDs 1, 2 y 3
                'activo' => $faker->boolean,
            ]);
        }

    }
}
