<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PaisSeeder::class,
            RegionSeeder::class,
            ProvinciaSeeder::class,
            DistritoSeeder::class,
            EleccionSeeder::class,
            CargoSeeder::class,
            //PartidoSeeder::class,
            //CategoriaSeeder::class,
            //EncuestaSeeder::class,
            //CandidatoSeeder::class,
            //CandidatoCargoSeeder::class,
            //CandidatoEncuestaSeeder::class,
            //VotoSeeder::class,
        ]);
    }
}
