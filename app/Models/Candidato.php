<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    /** @use HasFactory<\Database\Factories\CandidatoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'foto',
        'partido_id',
        'region_id',
        'provincia_id',
        'distrito_id',
        'activo',
    ];

    public function partido() //ok
    {
        return $this->belongsTo(Partido::class);
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

    public function cargos() //ok
    {
        return $this->hasMany(CandidatoCargo::class);
    }
}
