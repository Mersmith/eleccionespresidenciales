<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class EleccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('eleccions')->insert([
            [
                'nombre' => 'ELECCIONES GENERALES 2026',
                'tipo' => 'GENERALES',
                'fecha' => Carbon::create(2026, 4, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'ELECCIONES REGIONALES Y MUNICIPALES 2026',
                'tipo' => 'REGIONALES Y MUNICIPALES',
                'fecha' => Carbon::create(2026, 10, 9),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
