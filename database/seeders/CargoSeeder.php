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
                'nombre' => 'Presidente',
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
                'nombre' => 'Senado',
                'nivel' => 'regional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Parlamento Andino',
                'nivel' => 'nacional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Presidente Regional',
                'nivel' => 'regional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Alcalde Provincial',
                'nivel' => 'provincial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Alcalde Distrital',
                'nivel' => 'distrital',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
