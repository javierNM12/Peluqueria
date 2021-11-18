<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;
    protected $fillable = [
        'telefono',
        'nombre',
        'web'
    ];

    protected $table = 'proveedores';

    public function productos() {
        return $this->belongsToMany('App\Models\Productos', 'productos_proveedores', 'productos_id', 'proveedores_id')->withPivot('precio');
    }
}
