<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\Socialite\ProviderRedirectController;
use App\Http\Controllers\Socialite\ProviderCallbackController;
use App\Livewire\CategoriaCrud;
use App\Livewire\EncuestaCrear;
use App\Livewire\EncuestaEditar;
use App\Livewire\EncuestaLista;
use App\Livewire\EncuestaCandidatoLista;
use App\Livewire\EncuestaVotacion;
use App\Livewire\EncuestaResultado;
use App\Livewire\CandidatoLista;
use App\Livewire\CandidatoCrear;
use App\Livewire\CandidatoEditar;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/auth/{provider}/redirect', ProviderRedirectController::class)->name('auth.redirect');
Route::get('/auth/{provider}/callback', ProviderCallbackController::class)->name('auth.callback');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
