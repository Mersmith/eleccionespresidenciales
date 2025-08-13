<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    /** @use HasFactory<\Database\Factories\AnuncioFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'url_imagen',
        'link',
        'auspiciador_id',
        'candidato_id',
        'partido_id',
        'alianza_id',
        'pagina',
        'fecha_inicio',
        'fecha_fin',
        'activo',
    ];

    // Relaciones opcionales

    public function auspiciador()
    {
        return $this->belongsTo(Auspiciador::class);
    }

    public function candidato()
    {
        return $this->belongsTo(Candidato::class);
    }

    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }

    public function alianza()
    {
        return $this->belongsTo(Alianza::class);
    }
}
