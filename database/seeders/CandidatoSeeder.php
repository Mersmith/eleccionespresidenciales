<?php

namespace Database\Seeders;

use App\Models\Candidato;
use App\Models\Cargo;
use App\Models\Distrito;
use App\Models\Partido;
use App\Models\Provincia;
use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CandidatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partidos = Partido::pluck('id')->toArray();
        $cargos = Cargo::pluck('id')->toArray();

        // Crear 10 candidatos
        for ($i = 1; $i <= 10; $i++) {
            $nombre = "Candidato $i";

            // Elegir distrito aleatorio
            $distrito = Distrito::inRandomOrder()->first();

            if (!$distrito) {
                continue; // saltar si no hay distritos
            }

            // Obtener provincia y región relacionados
            $provincia = $distrito->provincia;
            $region = $provincia?->region;

            if (!$provincia || !$region) {
                continue; // saltar si falta algún dato
            }

            Candidato::create([
                'nombre' => $nombre,
                'slug' => Str::slug($nombre) . '-' . $i,
                'descripcion' => "Descripción del $nombre",
                'foto' => null,
                'partido_id' => fake()->randomElement($partidos),
                'region_id' => $region->id,
                'provincia_id' => $provincia->id,
                'distrito_id' => $distrito->id,
                'activo' => fake()->boolean(80),
            ]);
        }
    }
}
