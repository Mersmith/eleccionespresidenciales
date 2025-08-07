<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
    /** @use HasFactory<\Database\Factories\MembresiaFactory> */
    use HasFactory;

    protected $fillable = [
        'candidato_id',
        'mes',
        'pagado',
        'plan_id',
        'precio_pagado',
    ];

    public function candidato()
    {
        return $this->belongsTo(Candidato::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
