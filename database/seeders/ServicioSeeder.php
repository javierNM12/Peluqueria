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
            'id' => '1',
            'precio' => '20.45',
            'nombre' => 'Tinte básico',
            'desc' => 'Tinte básico sin crema',
        ]);
    }
}
