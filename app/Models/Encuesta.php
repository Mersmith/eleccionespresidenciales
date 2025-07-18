<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    /** @use HasFactory<\Database\Factories\EncuestaFactory> */
    use HasFactory;

    protected $fillable = [
        'titulo',
        'categoria_id',
        'fecha_inicio',
        'fecha_fin',
        'activa',
    ];

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }
    
    public function candidatos() {
        return $this->hasMany(Candidato::class);
    }
    
    public function votos() {
        return $this->hasMany(Voto::class);
    }
}
