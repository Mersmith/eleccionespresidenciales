<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    /** @use HasFactory<\Database\Factories\EncuestaFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'imagen_url',
        'categoria_id',
        'nivel_id',
        'cargo_id',
        'eleccion_id',
        'pais_id',
        'region_id',
        'provincia_id',
        'distrito_id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'activo',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function eleccion()
    {
        return $this->belongsTo(Eleccion::class);
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class);
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
    }

    public function candidatoEncuestas()
    {
        return $this->hasMany(CandidatoEncuesta::class);
    }

    public function candidatosPostulantes()
    {
        return $this->belongsToMany(CandidatoCargo::class, 'candidato_encuesta', 'encuesta_id', 'candidato_cargo_id')
            ->withTimestamps();
    }

    // Relación para acceder directamente a los candidatos a través de la elección
    public function candidatos()
    {
        return $this->eleccion?->candidatos();
    }

    public function candidatoCargos()
    {
        return $this->belongsToMany(CandidatoCargo::class, 'candidato_encuesta', 'encuesta_id', 'candidato_cargo_id')
            ->withTimestamps();
    }

    public function votos()
    {
        return $this->hasMany(Voto::class);
    }
}
