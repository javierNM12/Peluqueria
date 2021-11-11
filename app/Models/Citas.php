<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_hora',
        'descripcion',
        'finalizado',
        'clientes_id'
    ];

    public function servicios()
    {
        return $this->belongsToMany('App\Models\Servicios', 'citas_servicios', 'citas_id', 'servicios_id');
    }

    public function clientes()
    {
        return $this->belongsTo(Clientes::class);
    }
}
