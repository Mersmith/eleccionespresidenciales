<?php

namespace Database\Seeders;

use App\Models\Encuesta;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class EncuestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $encuestas = [
            [
                'nombre' => 'PRESIDENTE PERU 2026',
                'categoria_id' => 1,
                'eleccion_id' => 1,
                'cargo_id' => 1,
                'region_id' => null,
                'provincia_id' => null,
                'distrito_id' => null,
            ],
            [
                'nombre' => 'SENADO LIMA PERU 2026',
                'categoria_id' => 1,
                'eleccion_id' => 1,
                'cargo_id' => 3,
                'region_id' => 14,
                'provincia_id' => null,
                'distrito_id' => null,
            ],
            [
                'nombre' => 'DIPUTADO LIMA PERU 2026',
                'categoria_id' => 1,
                'eleccion_id' => 1,
                'cargo_id' => 3,
                'region_id' => 14,
                'provincia_id' => null,
                'distrito_id' => null,
            ],
            [
                'nombre' => 'ALCALDIA LIMA 2026',
                'categoria_id' => 1,
                'eleccion_id' => 2,
                'cargo_id' => 6,
                'region_id' => 14,
                'provincia_id' => 135,
                'distrito_id' => null,
            ],
            [
                'nombre' => 'ALCALDIA SAN JUAN DE LURIGANCHO 2026',
                'categoria_id' => 1,
                'eleccion_id' => 2,
                'cargo_id' => 7,
                'region_id' => 14,
                'provincia_id' => 135,
                'distrito_id' => 1369,
            ],
        ];

        foreach ($encuestas as $e) {
            Encuesta::create([
                'nombre' => $e['nombre'],
                'slug' => Str::slug($e['nombre']),
                'descripcion' => $faker->sentence,
                'imagen_url' => null,
                'categoria_id' => $e['categoria_id'],
                'eleccion_id' => $e['eleccion_id'],
                'cargo_id' => $e['cargo_id'],
                'region_id' => $e['region_id'],
                'provincia_id' => $e['provincia_id'],
                'distrito_id' => $e['distrito_id'],
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now()->addDays(30),
                'estado' => 'iniciada',
                'activo' => true,
            ]);
        }
    }
}
