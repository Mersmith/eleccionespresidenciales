<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    /** @use HasFactory<\Database\Factories\NivelFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'pais',
        'region',
        'provincia',
        'distrito',
    ];

    public function cargos() //ok
    {
        return $this->hasMany(Cargo::class);
    }

    public function encuestas() //ok
    {
        return $this->hasMany(Encuesta::class);
    }

    public function candidatoCargos()
    {
        return $this->hasMany(CandidatoCargo::class);
    }
}
