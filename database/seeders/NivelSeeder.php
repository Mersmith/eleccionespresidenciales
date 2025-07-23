<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nivels')->insert([
            [
                'nombre' => 'nacional',
                'pais' => true,
                'region' => false,
                'provincia' => false,
                'distrito' => false,
            ],
            [
                'nombre' => 'regional',
                'pais' => false,
                'region' => true,
                'provincia' => false,
                'distrito' => false,
            ],
            [
                'nombre' => 'provincial',
                'pais' => false,
                'region' => false,
                'provincia' => true,
                'distrito' => false,
            ],
            [
                'nombre' => 'distrital',
                'pais' => false,
                'region' => false,
                'provincia' => false,
                'distrito' => true,
            ],
        ]);
    }
}
