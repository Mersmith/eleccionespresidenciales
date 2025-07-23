<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEleccion extends Model
{
    /** @use HasFactory<\Database\Factories\TipoEleccionFactory> */
    use HasFactory;

    protected $table = 'tipo_eleccions';

    protected $fillable = [
        'nombre',
    ];

    public function eleccions()
    {
        return $this->hasMany(Eleccion::class, 'tipo_eleccion_id');
    }

    public function cargos()
    {
        return $this->hasMany(Cargo::class, 'tipo_eleccion_id');
    }

}
