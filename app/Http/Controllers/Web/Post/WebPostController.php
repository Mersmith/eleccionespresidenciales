<?php

namespace App\Http\Controllers\Web\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class WebPostController extends Controller
{
    public function __invoke($id, $slug = null)
    {
        $post = Post::with(['candidato', 'partido', 'alianza'])->findOrFail($id);

        // Determinar autor
        $autor_id = null;
        $autor_tipo = null;

        if ($post->candidato_id) {
            $autor_id = $post->candidato_id;
            $autor_tipo = 'candidato';
        } elseif ($post->partido_id) {
            $autor_id = $post->partido_id;
            $autor_tipo = 'partido';
        } elseif ($post->alianza_id) {
            $autor_id = $post->alianza_id;
            $autor_tipo = 'alianza';
        }

        // Traer otros posts del mismo autor con paginación (5 por página)
        $otrosPosts = Post::where(function ($query) use ($autor_tipo, $autor_id) {
            if ($autor_tipo === 'candidato') {
                $query->where('candidato_id', $autor_id);
            } elseif ($autor_tipo === 'partido') {
                $query->where('partido_id', $autor_id);
            } elseif ($autor_tipo === 'alianza') {
                $query->where('alianza_id', $autor_id);
            }
        })
            ->where('id', '!=', $id) // excluir post actual
            ->where('activo', 1)
            ->latest()
            ->paginate(5); // <-- paginación de 5 posts por página

        return view(
            'web.post.index',
            compact(
                'post',
                'otrosPosts'
            )
        );
    }
}
