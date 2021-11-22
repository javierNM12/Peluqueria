<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    protected $table = 'inventarios';
    protected $fillable = [
        'productos_id',
        'proveedores_id',
        'precio'
    ];

    public function productos()
    {
        return $this->belongsTo(Productos::class);
    }

    public function proveedores()
    {
        return $this->belongsTo(Proveedores::class);
    }
}
