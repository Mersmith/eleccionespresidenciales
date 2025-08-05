<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidatoCargo extends Model
{
    protected $table = 'candidato_cargo';

    protected $fillable = [
        'nivel_id',
        'candidato_id',
        'cargo_id',
        'eleccion_id',
        'partido_id',
        'alianza_id',
        'numero',
        'pais_id',
        'region_id',
        'provincia_id',
        'distrito_id',
        'principal',
        'electo',
    ];

    public function nivel() //ok
    {
        return $this->belongsTo(Nivel::class);
    }

    public function candidato() //ok
    {
        return $this->belongsTo(Candidato::class);
    }

    public function cargo() //ok
    {
        return $this->belongsTo(Cargo::class);
    }

    public function eleccion() //ok
    {
        return $this->belongsTo(Eleccion::class);
    }

    public function partido() //ok
    {
        return $this->belongsTo(Partido::class);
    }

    public function pais() //ok
    {
        return $this->belongsTo(Pais::class);
    }

    public function region() //ok
    {
        return $this->belongsTo(Region::class);
    }

    public function provincia() //ok
    {
        return $this->belongsTo(Provincia::class);
    }

    public function distrito() //ok
    {
        return $this->belongsTo(Distrito::class);
    }

    public function encuestas() //ok
    {
        return $this->belongsToMany(Encuesta::class, 'candidato_encuesta')
            ->withTimestamps()
            ->withPivot('id');
    }

    public function votos() //ok
    {
        return $this->hasMany(Voto::class);
    }

    public function alianza()
    {
        return $this->belongsTo(Alianza::class);
    }

    public function equipo()
    {
        return $this->hasMany(
            CandidatoCargoEquipo::class,
            'lider_candidato_cargo_id'
        );
    }

    // 🔹 Relación con equipo como integrante
    public function esIntegranteEn()
    {
        return $this->hasMany(
            CandidatoCargoEquipo::class,
            'integrante_candidato_cargo_id'
        );
    }

}
