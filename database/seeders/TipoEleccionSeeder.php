<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoEleccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_eleccions')->insert([
            [
                'nombre' => 'ELECCIONES GENERALES',
            ],
            [
                'nombre' => 'ELECCIONES REGIONALES Y MUNICIPALES',
            ]
        ]);
    }
}
