<?php

namespace App\Http\Controllers\Web\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class WebPostController extends Controller
{
    public function __invoke($id, $slug = null)
    {
        $post = Post::with(['candidato', 'partido', 'alianza'])->findOrFail($id);
        return view(
            'web.post.index',
            compact(
                'post',
            )
        );
    }
}
