<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    /** @use HasFactory<\Database\Factories\PartidoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'sigla',
        'slug',
        'logo',
        'descripcion',
        'activo',
    ];

    public function encuestas() //ok
    {
        return $this->hasMany(Encuesta::class);
    }

    public function candidatos()
    {
        return $this->hasMany(Candidato::class);
    }

    public function alianzas()
    {
        return $this->belongsToMany(Alianza::class, 'alianza_partidos');
    }

    //URL AMIGABLE
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
