<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderCallbackController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $provider)
    {
        if (!in_array($provider, ['github', 'google', 'facebook'])) {
            return redirect(route('login'))->withErrors(['provider' => 'Proveedor invalido']);
        }

        //$socialUser = Socialite::driver($provider)->user();

        $socialUser = Socialite::driver($provider)->stateless()->user();

        $user = User::where('email', $socialUser->email)->first();

        if ($user) {
            // Actualiza los datos del proveedor
            $user->update([
                'provider_id' => $socialUser->id,
                'provider_name' => $provider,
                'provider_token' => $socialUser->token,
                'provider_refresh_token' => $socialUser->refreshToken,
            ]);
        } else {
            // Crea un nuevo usuario si no existe
            $user = User::create([
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'provider_id' => $socialUser->id,
                'provider_name' => $provider,
                'provider_token' => $socialUser->token,
                'provider_refresh_token' => $socialUser->refreshToken,
            ]);
        }

        Auth::login($user);

        //return redirect('/dashboard');
        return redirect()->intended('/'); 
    }
}
