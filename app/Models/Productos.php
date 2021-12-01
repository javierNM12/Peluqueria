<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'minimo',
        'pvp',
        'tipo'
    ];

    public function inventario()
    {
        return $this->hasMany(Inventario::class);
    }

    public function historico()
    {
        return $this->hasMany(Historicos::class);
    }
}
