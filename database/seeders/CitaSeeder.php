<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Citas;

class CitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Citas::create([
            'id' => '1',
            'fecha_hora_i' => '2021-11-18 12:30:00',
            'fecha_hora_f' => '2021-11-18 13:00:00',
            'descripcion' => 'Tinte para javi',
            'finalizado' => '1',
            'clientes_id' => '1',
        ]);
    }
}
