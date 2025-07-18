<?php

namespace Database\Seeders;

use App\Models\Candidato;
use App\Models\Categoria;
use App\Models\Encuesta;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 3 categorías
        Categoria::factory(3)->create()->each(function ($categoria) {
            // Por cada categoría, crear 2 encuestas
            Encuesta::factory(2)->create([
                'categoria_id' => $categoria->id,
            ])->each(function ($encuesta) {
                // Por cada encuesta, crear 3 candidatos
                Candidato::factory(3)->create([
                    'encuesta_id' => $encuesta->id,
                ]);
            });
        });
    }
}
