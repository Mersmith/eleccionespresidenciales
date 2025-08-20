<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;   // 👈 importa la clase correcta
use Spatie\Sitemap\Tags\Url;  // 👈 importa la clase correcta

class GenerarSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generar';
    //protected $signature = 'app:generar-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera el sitemap.xml de la web';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sitemap = Sitemap::create();

        // Rutas estáticas
        $sitemap->add(Url::create(route('inicio')));
        $sitemap->add(Url::create(route('encuestas')));

        // Candidatos
        foreach (\App\Models\Candidato::all() as $candidato) {
            $sitemap->add(Url::create(route('candidato', [
                'id' => $candidato->id,
                'slug' => $candidato->slug,
            ])));
        }

        // Partidos
        foreach (\App\Models\Partido::all() as $partido) {
            $sitemap->add(Url::create(route('partido', [
                'id' => $partido->id,
                'slug' => $partido->slug,
            ])));
        }

        // Alianzas
        foreach (\App\Models\Alianza::all() as $alianza) {
            $sitemap->add(Url::create(route('alianza', [
                'id' => $alianza->id,
                'slug' => $alianza->slug,
            ])));
        }

        // Posts
        foreach (\App\Models\Post::all() as $post) {
            $sitemap->add(Url::create(route('post', [
                'id' => $post->id,
                'slug' => $post->slug,
            ])));
        }

        // Encuestas
        foreach (\App\Models\Encuesta::all() as $encuesta) {
            $sitemap->add(Url::create(route('encuesta', [
                'id' => $encuesta->id,
                'slug' => $encuesta->slug,
            ])));

            $sitemap->add(Url::create(route('encuesta.resultado', [
                'id' => $encuesta->id,
                'slug' => $encuesta->slug,
            ])));
        }

        // Guardar en public/sitemap.xml
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('✅ Sitemap generado en public/sitemap.xml');
    }
}
