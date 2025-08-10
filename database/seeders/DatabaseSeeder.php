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
            NivelSeeder::class,
            TipoEleccionSeeder::class,
            CargoSeeder::class,
            CategoriaSeeder::class,
            PlanSeeder::class,

            /*PartidoSeeder::class,
            EleccionSeeder::class,
            AlianzaSeeder::class,
            AuspiciadorSeeder::class,
            CandidatoSeeder::class,
            MembresiaSeeder::class,
            CandidatoCargoSeeder::class,
            EncuestaSeeder::class,
            CandidatoEncuestaSeeder::class,
            VotoSeeder::class,
            BannerSeeder::class,
            SliderSeeder::class,*/
        ]);
    }
}
