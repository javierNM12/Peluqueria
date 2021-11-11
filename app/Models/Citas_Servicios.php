<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citas_Servicios extends Model
{
    use HasFactory;
    protected $fillable = [
        'citas_id',
        'servicios_id',
    ];
}
