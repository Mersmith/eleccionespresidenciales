<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    /** @use HasFactory<\Database\Factories\DistritoFactory> */
    use HasFactory;

    public function provincia()//ok
    {
        return $this->belongsTo(Provincia::class, 'provincia_id');
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
