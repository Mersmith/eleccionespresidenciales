<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /** @use HasFactory<\Database\Factories\RegionFactory> */
    use HasFactory;

    public function pais()//ok
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }

    public function provincias()//ok
    {
        return $this->hasMany(Provincia::class, 'region_id');
    }

    public function encuestas() //ok
    {
        return $this->hasMany(Encuesta::class);
    }

    public function candidatos()
    {
        return $this->hasMany(Candidato::class);
    }
}
