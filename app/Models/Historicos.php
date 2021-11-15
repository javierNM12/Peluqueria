<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historicos extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_hora',
        'cantidad',
        'productos_id',
        'usuarios_id'
    ];

    public function productos()
    {
        return $this->belongsTo(Productos::class);
    }
}
