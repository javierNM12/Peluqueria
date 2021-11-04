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
        'pvp'
    ];

    public function proveedores(){
        return $this->belongsToMany( 'App\Models\Proveedores', 'productos_proveedores', 'producto_id', 'proveedor_id')->withPivot('precio');
      }
}
