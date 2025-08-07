<?php

use App\Livewire\Admin\Alianza\AlianzaEditarLivewire;
use App\Livewire\Admin\Alianza\AlianzaSocialLivewire;
use App\Livewire\Admin\Alianza\AlianzaTodasLivewire;
use App\Livewire\Admin\Alianza\CrearAlianzaLivewire;
use App\Livewire\Admin\Banner\BannerCrearLivewire;
use App\Livewire\Admin\Banner\BannerEditarLivewire;
use App\Livewire\Admin\Banner\BannerTodasLivewire;
use App\Livewire\Admin\Candidato\CandidatoCargoEquipoCrearLivewire;
use App\Livewire\Admin\Candidato\CandidatoCargoEquipoTodasLivewire;
use App\Livewire\Admin\Candidato\CandidatoCargoLivewire;
use App\Livewire\Admin\Candidato\CandidatoCrearLivewire;
use App\Livewire\Admin\Candidato\CandidatoEditarLivewire;
use App\Livewire\Admin\Candidato\CandidatoCargoEditarLivewire;
use App\Livewire\Admin\Candidato\CandidatoSocialLivewire;
use App\Livewire\Admin\Candidato\CandidatoTodasLivewire;
use App\Livewire\Admin\Eleccion\EleccionCrearLivewire;
use App\Livewire\Admin\Eleccion\EleccionEditarLivewire;
use App\Livewire\Admin\Eleccion\EleccionTodasLivewire;
use App\Livewire\Admin\Encuesta\EncuestaCandidatoLivewire;
use App\Livewire\Admin\Encuesta\EncuestaCrearLivewire;
use App\Livewire\Admin\Encuesta\EncuestaEditarLivewire;
use App\Livewire\Admin\Encuesta\EncuestaTodasLivewire;
use App\Livewire\Admin\Imagen\ImagenTodasLivewire;
use App\Livewire\Admin\Membresia\MembresiaGestionLivewire;
use App\Livewire\Admin\Membresia\MembresiaHistorialLivewire;
use App\Livewire\Admin\Membresia\MembresiaAuspiciadorGestionLivewire;
use App\Livewire\Admin\Membresia\MembresiaAuspiciadorHistorialLivewire;
use App\Livewire\Admin\Membresia\MembresiaTodasLivewire;
use App\Livewire\Admin\Partido\PartidoCrearLivewire;
use App\Livewire\Admin\Partido\PartidoEditarLivewire;
use App\Livewire\Admin\Partido\PartidoSocialLivewire;
use App\Livewire\Admin\Partido\PartidoTodasLivewire;
use App\Livewire\Admin\Plan\PlanCrearLivewire;
use App\Livewire\Admin\Plan\PlanEditarLivewire;
use App\Livewire\Admin\Plan\PlanTodasLivewire;
use App\Livewire\Admin\Slider\SliderEditarLivewire;
use App\Livewire\Admin\Auspiciador\AuspiciadorCrearLivewire;
use App\Livewire\Admin\Auspiciador\AuspiciadorEditarLivewire;
use App\Livewire\Admin\Auspiciador\AuspiciadorTodasLivewire;
use App\Livewire\Admin\Reporte\ReporteInicioLivewire;

use Illuminate\Support\Facades\Route;

Route::get('/eleccion', EleccionTodasLivewire::class)->name('eleccion.vista.todas');
Route::get('/eleccion/crear', EleccionCrearLivewire::class)->name('eleccion.vista.crear');
Route::get('/eleccion/editar/{id}', EleccionEditarLivewire::class)->name('eleccion.vista.editar');

//Route::get('/cargo', CargoTodasLivewire::class)->name('cargo.vista.todas');
//Route::get('/cargo/crear', CargoCrearLivewire::class)->name('cargo.vista.crear');
//Route::get('/cargo/editar/{id}', CargoEditarLivewire::class)->name('cargo.vista.editar');

Route::get('/partido', PartidoTodasLivewire::class)->name('partido.vista.todas');
Route::get('/partido/crear', PartidoCrearLivewire::class)->name('partido.vista.crear');
Route::get('/partido/editar/{id}', PartidoEditarLivewire::class)->name('partido.vista.editar');
Route::get('/partido/red-social/{id}', PartidoSocialLivewire::class)->name('partido.social.editar');

Route::get('/alianza', AlianzaTodasLivewire::class)->name('alianza.vista.todas');
Route::get('/alianza/crear', CrearAlianzaLivewire::class)->name('alianza.vista.crear');
Route::get('/alianza/editar/{id}', AlianzaEditarLivewire::class)->name('alianza.vista.editar');
Route::get('/alianza/red-social/{id}', AlianzaSocialLivewire::class)->name('alianza.social.editar');

Route::get('/plan', PlanTodasLivewire::class)->name('plan.vista.todas');
Route::get('/plan/crear', PlanCrearLivewire::class)->name('plan.vista.crear');
Route::get('/plan/editar/{id}', PlanEditarLivewire::class)->name('plan.vista.editar');

Route::get('/membresia', MembresiaTodasLivewire::class)->name('membresia.vista.todas');
Route::get('/membresia/gestion', MembresiaGestionLivewire::class)->name('membresia.vista.gestion');
Route::get('/membresia/historial', MembresiaHistorialLivewire::class)->name('membresia.vista.historial');
Route::get('/membresia/auspiciador/gestion', MembresiaAuspiciadorGestionLivewire::class)->name('membresia.auspiciador.vista.gestion');
Route::get('/membresia/auspiciador/historial', MembresiaAuspiciadorHistorialLivewire::class)->name('membresia.auspiciador.vista.historial');

//Route::get('/categoria', CategoriaTodasLivewire::class)->name('categoria.vista.todas');
//Route::get('/categoria/crear', CategoriaCrearLivewire::class)->name('categoria.vista.crear');
//Route::get('/categoria/editar/{id}', CategoriaEditarLivewire::class)->name('categoria.vista.editar');

Route::get('/encuesta', EncuestaTodasLivewire::class)->name('encuesta.vista.todas');
Route::get('/encuesta/crear', EncuestaCrearLivewire::class)->name('encuesta.vista.crear');
Route::get('/encuesta/editar/{id}', EncuestaEditarLivewire::class)->name('encuesta.vista.editar');
Route::get('/encuesta/{id}/candidato', EncuestaCandidatoLivewire::class)->name('encuesta.candidato.editar');

Route::get('/auspiciador', AuspiciadorTodasLivewire::class)->name('auspiciador.vista.todas');
Route::get('/auspiciador/crear', AuspiciadorCrearLivewire::class)->name('auspiciador.vista.crear');
Route::get('/auspiciador/editar/{id}', AuspiciadorEditarLivewire::class)->name('auspiciador.vista.editar');

Route::get('/candidato', CandidatoTodasLivewire::class)->name('candidato.vista.todas');
Route::get('/candidato/crear', CandidatoCrearLivewire::class)->name('candidato.vista.crear');
Route::get('/candidato/editar/{id}', CandidatoEditarLivewire::class)->name('candidato.vista.editar');
Route::get('/candidato/cargo/{id}', CandidatoCargoLivewire::class)->name('candidato.cargo.crear');
Route::get('/candidato/cargo/editar/{id}', CandidatoCargoEditarLivewire::class)->name('candidato.cargo.editar');
Route::get('/candidato/cargo-equipo/crear/{id}', CandidatoCargoEquipoCrearLivewire::class)->name('candidato.cargo.equipo.crear');
Route::get('/candidato/cargo-equipo/editar/{id}', CandidatoCargoEquipoTodasLivewire::class)->name('candidato.cargo.equipo.editar');
Route::get('/candidato/red-social/{id}', CandidatoSocialLivewire::class)->name('candidato.social.editar');

Route::get('/reporte', ReporteInicioLivewire::class)->name('reporte.todas');

Route::get('/banner', BannerTodasLivewire::class)->name('banner.vista.todas');
Route::get('/banner/crear', BannerCrearLivewire::class)->name('banner.vista.crear');
Route::get('/banner/editar/{id}', BannerEditarLivewire::class)->name('banner.vista.editar');

Route::get('/slider', SliderEditarLivewire::class)->name('slider.vista.todas');

Route::get('/imagen', ImagenTodasLivewire::class)->name('imagen.vista.todas');
