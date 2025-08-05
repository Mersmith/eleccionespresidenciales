<?php

namespace Database\Seeders;

use App\Models\Alianza;
use App\Models\Partido;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AlianzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();

        // eleccion fija para este seeder
        $eleccionId = 1;

        // Obtener todos los partidos
        $partidosIds = Partido::pluck('id')->toArray();

        if (empty($partidosIds)) {
            $this->command->warn('⚠ No hay partidos registrados. Primero crea partidos antes de ejecutar este seeder.');
            return;
        }

        // Obtener partidos ya asignados a alianzas de la elección 1
        $asignados = DB::table('alianza_partidos')
            ->join('alianzas', 'alianza_partidos.alianza_id', '=', 'alianzas.id')
            ->where('alianzas.eleccion_id', $eleccionId)
            ->pluck('alianza_partidos.partido_id')
            ->toArray();

        // Disponibles = partidos totales - asignados
        $disponibles = array_values(array_diff($partidosIds, $asignados));

        // Si no hay partidos disponibles, salimos
        if (empty($disponibles)) {
            $this->command->warn('⚠ No hay partidos disponibles para asignar a alianzas en la elección ' . $eleccionId);
            return;
        }

        // Crear hasta 10 alianzas (o menos si no hay suficientes partidos)
        $cantidadAlianzas = 10;

        for ($i = 1; $i <= $cantidadAlianzas; $i++) {
            $nombre = $faker->unique()->company . ' Alianza';

            $alianza = Alianza::create([
                'nombre' => $nombre,
                'slug' => Str::slug($nombre),
                'sigla' => strtoupper(substr($nombre, 0, 3)),
                'descripcion' => $faker->paragraph(),
                //'logo' => null,
                'plan_gobierno' => $faker->boolean(40) ? $faker->url : null,
                //'redes_sociales' => json_encode([]),
                'eleccion_id' => $eleccionId,
                'activo' => $faker->boolean(80) ? 1 : 0,
            ]);

            // Recalcular disponibles (por si se asignaron antes)
            $disponibles = array_values(array_diff($disponibles, DB::table('alianza_partidos')
                    ->pluck('partido_id')
                    ->toArray()));

            // Si ya no hay disponibles, rompemos el loop
            if (empty($disponibles)) {
                $this->command->info('No quedan partidos disponibles para más alianzas en la elección ' . $eleccionId);
                break;
            }

            // Cuántos partidos queremos asociar a esta alianza: entre 1 y 5,
            // pero no más de la cantidad de disponibles
            $maxParaAsignar = min(5, count($disponibles));
            $take = rand(1, $maxParaAsignar);

            // Tomar partidos aleatorios de los disponibles
            $randomPartidos = collect($disponibles)->shuffle()->take($take)->toArray();

            foreach ($randomPartidos as $partidoId) {
                DB::table('alianza_partidos')->insert([
                    'alianza_id' => $alianza->id,
                    'partido_id' => $partidoId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Remover partido asignado de la lista de disponibles
                $disponibles = array_values(array_diff($disponibles, [$partidoId]));
            }
        }

        $this->command->info('Seeder de alianzas completado.');
    }
}
