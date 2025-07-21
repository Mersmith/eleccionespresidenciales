<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Diputado',
                'nivel' => 'regional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Senador',
                'nivel' => 'regional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Representante al Parlamento Andino',
                'nivel' => 'nacional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Gobernador regional',
                'nivel' => 'regional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Alcalde provincial',
                'nivel' => 'provincial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Alcalde distrital',
                'nivel' => 'distrital',
                'created_at' => now(),
                'updated_at' => now(),
            ],  
            [
                'nombre' => 'Vicepresidente de la República',
                'nivel' => 'nacional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Vicegobernador regional',
                'nivel' => 'regional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Consejero regional',
                'nivel' => 'regional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Regidor provincial',
                'nivel' => 'provincial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Regidor distrital',
                'nivel' => 'distrital',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
