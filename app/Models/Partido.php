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
        'redes_sociales',
        'plan_gobierno',
        'descripcion',
        'color',
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

    public function anuncios()
    {
        return $this->hasMany(Anuncio::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function elecciones()
    {
        return $this->belongsToMany(Eleccion::class, 'partido_eleccion_tables')
            ->withPivot(['numero_en_papeleta', 'activo'])
            ->withTimestamps();
    }

    //URL AMIGABLE
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
