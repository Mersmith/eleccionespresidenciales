<?php

namespace App\Http\Controllers\Web\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebLoginAdminController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.eleccion.vista.todas');
        }

        return view('web.login.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.eleccion.vista.todas');
            }

            Auth::logout();
            return back()->withErrors([
                'email' => 'Acceso denegado. Solo administradores pueden ingresar aquí.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas.',
        ]);
    }
}
