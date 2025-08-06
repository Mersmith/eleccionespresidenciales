<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EleccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('eleccions')->insert([
            [
                'nombre' => 'ELECCIONES GENERALES 2026',
                'slug' => Str::slug('ELECCIONES GENERALES 2026'),
                'descripcion' => $faker->sentence,
                'tipo_eleccion_id' => 1,
                'imagen_ruta' => 'http://127.0.0.1:8000/assets/images/portada/portada-1.jpg',
                'fecha_votacion' => Carbon::create(2026, 4, 10),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'ELECCIONES REGIONALES Y MUNICIPALES 2026',
                'slug' => Str::slug('ELECCIONES REGIONALES Y MUNICIPALES 2026'),
                'descripcion' => $faker->sentence,
                'tipo_eleccion_id' => 2,
                'imagen_ruta' => 'http://127.0.0.1:8000/assets/images/portada/portada-1.jpg',
                'fecha_votacion' => Carbon::create(2026, 10, 9),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'ELECCIONES GENERALES 2025',
                'slug' => Str::slug('ELECCIONES GENERALES 2025'),
                'descripcion' => $faker->sentence,
                'tipo_eleccion_id' => 1,
                'imagen_ruta' => 'http://127.0.0.1:8000/assets/images/portada/portada-1.jpg',
                'fecha_votacion' => Carbon::create(2025, 4, 10),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'ELECCIONES REGIONALES Y MUNICIPALES 2025',
                'slug' => Str::slug('ELECCIONES REGIONALES Y MUNICIPALES 2025'),
                'descripcion' => $faker->sentence,
                'tipo_eleccion_id' => 2,
                'imagen_ruta' => 'http://127.0.0.1:8000/assets/images/portada/portada-1.jpg',
                'fecha_votacion' => Carbon::create(2025, 10, 9),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'ELECCIONES GENERALES 2024',
                'slug' => Str::slug('ELECCIONES GENERALES 2024'),
                'descripcion' => $faker->sentence,
                'tipo_eleccion_id' => 1,
                'imagen_ruta' => 'http://127.0.0.1:8000/assets/images/portada/portada-1.jpg',
                'fecha_votacion' => Carbon::create(2024, 4, 10),
                'activo' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'ELECCIONES REGIONALES Y MUNICIPALES 2024',
                'slug' => Str::slug('ELECCIONES REGIONALES Y MUNICIPALES 2024'),
                'descripcion' => $faker->sentence,
                'tipo_eleccion_id' => 2,
                'imagen_ruta' => 'http://127.0.0.1:8000/assets/images/portada/portada-1.jpg',
                'fecha_votacion' => Carbon::create(2024, 10, 9),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
