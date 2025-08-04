<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Admin\Eleccion\EleccionTodasLivewire;
use App\Livewire\Admin\Eleccion\EleccionCrearLivewire;
use App\Livewire\Admin\Eleccion\EleccionEditarLivewire;
use App\Livewire\Admin\Cargo\CargoTodasLivewire;
use App\Livewire\Admin\Cargo\CargoCrearLivewire;
use App\Livewire\Admin\Cargo\CargoEditarLivewire;
use App\Livewire\Admin\Partido\PartidoTodasLivewire;
use App\Livewire\Admin\Partido\PartidoCrearLivewire;
use App\Livewire\Admin\Partido\PartidoEditarLivewire;
use App\Livewire\Admin\Categoria\CategoriaTodasLivewire;
use App\Livewire\Admin\Categoria\CategoriaCrearLivewire;
use App\Livewire\Admin\Categoria\CategoriaEditarLivewire;
use App\Livewire\Admin\Encuesta\EncuestaTodasLivewire;
use App\Livewire\Admin\Encuesta\EncuestaCrearLivewire;
use App\Livewire\Admin\Encuesta\EncuestaEditarLivewire;
use App\Livewire\Admin\Encuesta\EncuestaCandidatoLivewire;
use App\Livewire\Admin\Candidato\CandidatoTodasLivewire;
use App\Livewire\Admin\Candidato\CandidatoCrearLivewire;
use App\Livewire\Admin\Candidato\CandidatoEditarLivewire;
use App\Livewire\Admin\Candidato\CandidatoCargoLivewire;
use App\Livewire\Admin\Candidato\CandidatoSocialLivewire;
use App\Livewire\Admin\Banner\BannerTodasLivewire;
use App\Livewire\Admin\Banner\BannerCrearLivewire;
use App\Livewire\Admin\Banner\BannerEditarLivewire;
use App\Livewire\Admin\Slider\SliderEditarLivewire;
use App\Livewire\Admin\Imagen\ImagenTodasLivewire;

Route::get('/eleccion', EleccionTodasLivewire::class)->name('eleccion.vista.todas');
Route::get('/eleccion/crear', EleccionCrearLivewire::class)->name('eleccion.vista.crear');
Route::get('/eleccion/editar/{id}', EleccionEditarLivewire::class)->name('eleccion.vista.editar');

//Route::get('/cargo', CargoTodasLivewire::class)->name('cargo.vista.todas');
//Route::get('/cargo/crear', CargoCrearLivewire::class)->name('cargo.vista.crear');
//Route::get('/cargo/editar/{id}', CargoEditarLivewire::class)->name('cargo.vista.editar');

Route::get('/partido', PartidoTodasLivewire::class)->name('partido.vista.todas');
Route::get('/partido/crear', PartidoCrearLivewire::class)->name('partido.vista.crear');
Route::get('/partido/editar/{id}', PartidoEditarLivewire::class)->name('partido.vista.editar');

//Route::get('/categoria', CategoriaTodasLivewire::class)->name('categoria.vista.todas');
//Route::get('/categoria/crear', CategoriaCrearLivewire::class)->name('categoria.vista.crear');
//Route::get('/categoria/editar/{id}', CategoriaEditarLivewire::class)->name('categoria.vista.editar');

Route::get('/encuesta', EncuestaTodasLivewire::class)->name('encuesta.vista.todas');
Route::get('/encuesta/crear', EncuestaCrearLivewire::class)->name('encuesta.vista.crear');
Route::get('/encuesta/editar/{id}', EncuestaEditarLivewire::class)->name('encuesta.vista.editar');
Route::get('/encuesta/{id}/candidato', EncuestaCandidatoLivewire::class)->name('encuesta.candidato.editar');

Route::get('/candidato', CandidatoTodasLivewire::class)->name('candidato.vista.todas');
Route::get('/candidato/crear', CandidatoCrearLivewire::class)->name('candidato.vista.crear');
Route::get('/candidato/editar/{id}', CandidatoEditarLivewire::class)->name('candidato.vista.editar');
Route::get('/candidato/cargo/{id}', CandidatoCargoLivewire::class)->name('candidato.cargo.editar');
Route::get('/candidato/red-social/{id}', CandidatoSocialLivewire::class)->name('candidato.social.editar');

Route::get('/banner', BannerTodasLivewire::class)->name('banner.vista.todas');
Route::get('/banner/crear', BannerCrearLivewire::class)->name('banner.vista.crear');
Route::get('/banner/editar/{id}', BannerEditarLivewire::class)->name('banner.vista.editar');

Route::get('/slider', SliderEditarLivewire::class)->name('slider.vista.todas');

Route::get('/imagen', ImagenTodasLivewire::class)->name('imagen.vista.todas');