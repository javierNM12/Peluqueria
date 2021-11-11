<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos_Proveedores extends Model
{
    use HasFactory;
    protected $fillable = [
        'productos_id',
        'proveedores_id',
        'precio',
    ];
}
