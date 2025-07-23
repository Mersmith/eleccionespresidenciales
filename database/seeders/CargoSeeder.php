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
                'nivel' => 'nacional',
                'eleccion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Diputado',
                'nivel' => 'regional',
                'eleccion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Senador',
                'nivel' => 'regional',
                'eleccion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Representante al Parlamento Andino',
                'nivel' => 'nacional',
                'eleccion_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Gobernador regional',
                'nivel' => 'regional',
                'eleccion_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Alcalde provincial',
                'nivel' => 'provincial',
                'eleccion_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Alcalde distrital',
                'nivel' => 'distrital',
                'eleccion_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Vicepresidente de la República',
                'nivel' => 'nacional',
                'eleccion_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Vicegobernador regional',
                'nivel' => 'regional',
                'eleccion_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Consejero regional',
                'nivel' => 'regional',
                'eleccion_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Regidor provincial',
                'nivel' => 'provincial',
                'eleccion_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Regidor distrital',
                'nivel' => 'distrital',
                'eleccion_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
