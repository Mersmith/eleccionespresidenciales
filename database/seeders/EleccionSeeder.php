<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

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
                'imagen_ruta' => null,
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
                'imagen_ruta' => null,
                'fecha_votacion' => Carbon::create(2026, 10, 9),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
