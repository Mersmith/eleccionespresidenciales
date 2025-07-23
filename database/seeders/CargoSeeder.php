<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cargos')->insert([
            [
                'nombre' => 'Presidente de la República',
                'nivel_id' => 1,
                'tipo_eleccion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Vicepresidente de la República',
                'nivel_id' => 1,
                'tipo_eleccion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Senador',
                'nivel_id' => 2,
                'tipo_eleccion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Diputado',
                'nivel_id' => 2,
                'tipo_eleccion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Representante al Parlamento Andino',
                'nivel_id' => 1,
                'tipo_eleccion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Gobernador regional',
                'nivel_id' => 2,
                'tipo_eleccion_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Vicegobernador regional',
                'nivel_id' => 2,
                'tipo_eleccion_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Consejero regional',
                'nivel_id' => 2,
                'tipo_eleccion_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Alcalde provincial',
                'nivel_id' => 3,
                'tipo_eleccion_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Regidor provincial',
                'nivel_id' => 3,
                'tipo_eleccion_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Alcalde distrital',
                'nivel_id' => 4,
                'tipo_eleccion_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Regidor distrital',
                'nivel_id' => 4,
                'tipo_eleccion_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
