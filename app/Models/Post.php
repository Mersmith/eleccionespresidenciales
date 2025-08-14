<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'titulo',
        'slug',
        'image',
        'content',
        'meta_title',
        'meta_description',
        'candidato_id',
        'partido_id',
        'alianza_id',
        'views',
        'orden',
        'activo',
    ];

    // Relaciones
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

    //URL AMIGABLE
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
