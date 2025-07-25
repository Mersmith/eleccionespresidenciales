<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    /** @use HasFactory<\Database\Factories\ProvinciaFactory> */
    use HasFactory;

    public function region() //ok
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function distritos()//ok
    {
        return $this->hasMany(Distrito::class, 'provincia_id');
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
