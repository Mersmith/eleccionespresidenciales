<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function categoria() //ok
    {
        return $this->belongsTo(Categoria::class);
    }

    public function nivel() //ok
    {
        return $this->belongsTo(Nivel::class);
    }

    public function cargo() //ok
    {
        return $this->belongsTo(Cargo::class);
    }

    public function eleccion() //ok
    {
        return $this->belongsTo(Eleccion::class);
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

    public function candidatoCargos() //ok
    {
        return $this->belongsToMany(CandidatoCargo::class, 'candidato_encuesta')
            ->withTimestamps()
            ->withPivot('id');
    }

    public function votos() //ok
    {
        return $this->hasMany(Voto::class);
    }

    public function candidatoEncuestas() //ok
    {
        return $this->hasMany(CandidatoEncuesta::class);
    }

    //URL AMIGABLE
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getFechaFinFormateadaAttribute()
    {
        return Carbon::parse($this->fecha_fin)->format('Y-m-d');
    }

    // Accesor para saber si la encuesta ya finalizó
    public function getYaFinalizoAttribute()
    {
        return Carbon::parse($this->fecha_fin)->isPast();
    }

}
