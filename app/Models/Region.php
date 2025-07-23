<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /** @use HasFactory<\Database\Factories\RegionFactory> */
    use HasFactory;

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function provincias()
    {
        return $this->hasMany(Provincia::class);
    }

    public function encuestas()
    {
        return $this->hasMany(Encuesta::class);
    }

    public function candidatos()
    {
        return $this->hasMany(Candidato::class);
    }
}
