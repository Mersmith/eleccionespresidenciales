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
        'celular',
        'observacion',
        'foto',
        'video_presentacion',
        'redes_sociales',
        'slider',
        'plan_gobierno',
        'datos_personales',
        'datos_educativos',
        'experiencia_laboral',
        'propuestas',
        'material',
        'contacto',
        'partido_id',
        'plan_id',
        'region_id',
        'provincia_id',
        'distrito_id',
        'candidato_oficial',
        'activo',
    ];

    protected $casts = [
        'datos_personales' => 'array',
        'datos_educativos' => 'array',
        'experiencia_laboral' => 'array',
        'propuestas' => 'array',
        'material' => 'array',
        'contacto' => 'array',
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

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function membresias()
    {
        return $this->hasMany(Membresia::class);
    }

    public function membresiaActiva()
    {
        return $this->hasOne(Membresia::class)
            ->where('mes', now()->startOfMonth())
            ->where('pagado', true);
    }

    public function anuncios()
    {
        return $this->hasMany(Anuncio::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //URL AMIGABLE
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
