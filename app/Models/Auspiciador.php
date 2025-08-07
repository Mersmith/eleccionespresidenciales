<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auspiciador extends Model
{
    /** @use HasFactory<\Database\Factories\AuspiciadorFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'empresa',
        'celular',
        'observacion',
        'plan_id',
        'activo',
    ];

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
}
