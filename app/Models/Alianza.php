<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alianza extends Model
{
    /** @use HasFactory<\Database\Factories\AlianzaFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'sigla',
        'slug',
        'logo',
        'redes_sociales',
        'plan_gobierno',
        'descripcion',
        'eleccion_id',
        'color',
        'activo',
    ];

    public function partidos()
    {
        return $this->belongsToMany(Partido::class, 'alianza_partidos');
    }

    public function eleccion()
    {
        return $this->belongsTo(Eleccion::class);
    }

    public function anuncios()
    {
        return $this->hasMany(Anuncio::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
