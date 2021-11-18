<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Historicos;

class HistoricoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Historicos::create([
            'id' => '1',
            'fecha_hora' => '2021-11-18 08:20:36',
            'cantidad' => '5',
            'productos_id' => '1',
            'users_id' => '1',
        ]);
    }
}
