<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'existencias',
        'minimo',
        'pvp',
        'tipo'
    ];

    public function proveedores()
    {
        return $this->belongsToMany('App\Models\Proveedores', 'productos_proveedores', 'productos_id', 'proveedores_id')->withPivot('precio');
    }

    public function historico()
    {
        return $this->hasMany(Historicos::class);
    }
}
