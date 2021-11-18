<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Citas_Servicios;

class CitaServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Citas_Servicios::create([
            'id' => '1',
            'citas_id' => '1',
            'servicios_id' => '1',
        ]);
    }
}
