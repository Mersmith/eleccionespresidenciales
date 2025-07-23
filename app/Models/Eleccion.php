<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleccion extends Model
{
    /** @use HasFactory<\Database\Factories\EleccionFactory> */
    use HasFactory;

    const GENERAL = 'GENERALES';
    const MUNICIPAL = 'REGIONALES Y MUNICIPALES';

    protected $guarded = ['id', 'created_at', 'update_at'];

    public function cargos()
    {
        return $this->hasMany(Cargo::class);
    }

    public function candidatos()
    {
        return $this->hasMany(Candidato::class);
    }

    //URL AMIGABLE
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
