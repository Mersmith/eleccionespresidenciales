<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VotoHistorial extends Model
{
    protected $table = 'votos_historial'; // Nombre exacto de tu tabla
    protected $fillable = ['user_id', 'encuesta_id', 'candidato_cargo_id', 'fecha_voto'];
}
