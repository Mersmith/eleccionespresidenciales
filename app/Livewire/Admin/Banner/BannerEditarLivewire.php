<?php

namespace App\Livewire\Admin\Banner;

use App\Models\Banner;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin.layout-admin')]
class BannerEditarLivewire extends Component
{
    public $banner;

    public $nombre;
    public $imagen_computadora;
    public $imagen_movil;
    public $link;
    public $activo;

    protected function rules()
    {
        return [
            'nombre' => 'required|unique:banners,nombre,'. $this->banner->id,
            'imagen_computadora' => 'required|url',
            'imagen_movil' => 'required|url',
            'link' => 'required|url',            
            'activo' => 'required|numeric|regex:/^\d{1}$/',
        ];
    }

    public function mount($id)
    {
        $this->banner = Banner::findOrFail($id);

        $this->nombre = $this->banner->nombre;
        $this->imagen_computadora = $this->banner->imagen_computadora;
        $this->imagen_movil = $this->banner->imagen_movil;
        $this->link = $this->banner->link;
        $this->activo = $this->banner->activo;
    }

    public function editarBanner()
    {
        $this->validate();

        $this->banner->update([
            'nombre' => $this->nombre,
            'imagen_computadora' => $this->imagen_computadora,
            'imagen_movil' => $this->imagen_movil,
            'link' => $this->link,
            'activo' => $this->activo,
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        //return redirect()->route('admin.banner.vista.todas');
    }

  

    public function render()
    {
        return view('livewire.admin.banner.banner-editar-livewire');
    }
}
