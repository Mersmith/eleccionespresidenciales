<?php

namespace App\Livewire\Admin\Banner;

use App\Models\Banner;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class BannerCrearLivewire extends Component
{
    public $nombre;
    public $imagen_computadora;
    public $imagen_movil;
    public $link;
    public $activo = "0";

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:banners,nombre',
            'imagen_computadora' => 'required|url',
            'imagen_movil' => 'required|url',
            'link' => 'required|url',            
            'activo' => 'required|numeric|regex:/^\d{1}$/',
        ];
    }

    public function crearBanner()
    {
        $this->validate();

        Banner::create([
            'nombre' => $this->nombre,
            'imagen_computadora' => $this->imagen_computadora,
            'imagen_movil' => $this->imagen_movil,
            'link' => $this->link,
            'activo' => $this->activo,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        return redirect()->route('admin.banner.vista.todas');
    }

    public function render()
    {
        return view('livewire.admin.banner.banner-crear-livewire');
    }
}
