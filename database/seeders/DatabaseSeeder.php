<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            BannerSeeder::class,
            SliderSeeder::class,
            UserSeeder::class,
            PaisSeeder::class,
            RegionSeeder::class,
            ProvinciaSeeder::class,
            DistritoSeeder::class,
            NivelSeeder::class,
            TipoEleccionSeeder::class,
            EleccionSeeder::class,
            CargoSeeder::class,
            PartidoSeeder::class,
            CategoriaSeeder::class,
            CandidatoSeeder::class,
            CandidatoCargoSeeder::class,
            EncuestaSeeder::class,
            //CandidatoEncuestaSeeder::class,
            //VotoSeeder::class,
        ]);
    }
}
