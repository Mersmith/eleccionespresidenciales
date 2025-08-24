<?php

namespace App\Console\Commands;

use App\Models\ResultadoEncuesta;
use App\Models\Voto;
use App\Models\VotoHistorial;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Encuesta;

class CerrarEncuesta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'encuesta:cerrar {encuesta_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cerrar encuesta: mover votos a historial y dejar resultados finales';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $encuestaId = $this->argument('encuesta_id');

        $encuesta = Encuesta::find($encuestaId);

        if (!$encuesta) {
            $this->error("Encuesta $encuestaId no encontrada.");
            return;
        }

        if ($encuesta->estado === 'finalizada') {
            $this->info("La encuesta $encuestaId ya está finalizada. No se hace nada.");
            return;
        }

        DB::transaction(function () use ($encuesta) {

            // 1️⃣ Cambiar estado
            $encuesta->estado = 'finalizada';
            $encuesta->activo = false;
            $encuesta->save();

            // 2️⃣ Copiar votos a historial de manera masiva
            $votos = Voto::where('encuesta_id', $encuesta->id)->get(['user_id', 'encuesta_id', 'candidato_cargo_id', 'fecha_voto']);

            if ($votos->isNotEmpty()) {
                $insertData = $votos->map(fn($v) => [
                    'user_id' => $v->user_id,
                    'encuesta_id' => $v->encuesta_id,
                    'candidato_cargo_id' => $v->candidato_cargo_id,
                    'fecha_voto' => $v->fecha_voto,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])->toArray();

                // Insert masivo
                VotoHistorial::insert($insertData);
            }

            // 3️⃣ Marcar resultados como cerrados
            ResultadoEncuesta::where('encuesta_id', $encuesta->id)
                ->update(['cerrada' => true]);

            // 4️⃣ Borrar votos de la tabla activa
            Voto::where('encuesta_id', $encuesta->id)->delete();
        });

        $this->info("Encuesta $encuestaId cerrada y votos archivados.");
    }
}
