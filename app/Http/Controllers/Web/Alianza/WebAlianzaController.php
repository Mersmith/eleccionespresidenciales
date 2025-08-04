<?php

namespace App\Http\Controllers\Web\Alianza;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alianza;

class WebAlianzaController extends Controller
{
    public function __invoke($id, $slug = null)
    {
        $alianza = $this->getWebAlianza($id);

        return view(
            'web.alianza.index',
            compact(
                'alianza', //ok
            )
        );
    }    

    public function getWebAlianza($id)
    {
        $alianza = Alianza::with('partidos')->findOrFail($id);

        return $alianza;
    }


}
