<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class ProviderRedirectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $provider)
    {
        if (!in_array($provider, ['github', 'google', 'facebook'])) {
            return redirect(route('login'))->withErrors(['provider' => 'Proveedor invalido']);
        }

        session(['url.intended' => url()->previous()]); // ← Guarda la URL actual

        try{
            return Socialite::driver($provider)->redirect();
        } catch(\Exception $e){
            //return redirect(route('login'))->withErrors(['provider' => 'Algo salio mal']);
            return redirect()->intended('/'); 
        }
    }
}
