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
        'precio', // -> hace falta guardarlo si solamente es para un historial de transacciones? !!! Alomejor si para comprobar las ganancias !!!
        'users_id'
    ];

    public function productos()
    {
        return $this->belongsTo(Productos::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
