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
                'nombre' => 'Elección Presidencial 2026',
                'tipo' => 'presidencial',
                'fecha' => Carbon::create(2026, 4, 10), // Ejemplo de fecha
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Elección Municipal 2026',
                'tipo' => 'municipal',
                'fecha' => Carbon::create(2026, 10, 9), // Ejemplo de fecha
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
