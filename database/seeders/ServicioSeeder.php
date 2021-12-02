<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicios;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Servicios::create([
            'precio' => '10.00',
            'nombre' => 'Marcado con rulos',
            'desc' => 'Marcado de rulos a mano',
        ]);

        Servicios::create([
            'precio' => '29.00',
            'nombre' => 'Tinte en todo el pelo',
            'desc' => 'Tinte clásico',
        ]);

        Servicios::create([
            'precio' => '12.5',
            'nombre' => 'Cera caliente piernas enteras',
            'desc' => 'Sesión completa con crema incluida',
        ]);

        Servicios::create([
            'precio' => '10.5',
            'nombre' => 'Pedicura',
            'desc' => 'Pedicura y pintauñas, no inlcuye masaje',
        ]);

        Servicios::create([
            'precio' => '11.00',
            'nombre' => 'Corte caballero',
            'desc' => 'Corte a elección caballeros pelo corto',
        ]);
    }
}
