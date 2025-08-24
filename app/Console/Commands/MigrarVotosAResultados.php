<?php

namespace App\Console\Commands;

use App\Models\ResultadoEncuesta;
use App\Models\Voto;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrarVotosAResultados extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'encuesta:migrar-votos-a-resultados';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrar los votos existentes a ResultadoEncuesta';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $votos = Voto::all();

        foreach ($votos as $voto) {
            ResultadoEncuesta::updateOrCreate(
                [
                    'encuesta_id' => $voto->encuesta_id,
                    'candidato_cargo_id' => $voto->candidato_cargo_id,
                ],
                [
                    'total_votos' => DB::raw('total_votos + 1'),
                ]
            );
        }

        $this->info('Se han migrado los votos existentes a ResultadoEncuesta.');
    }
}
