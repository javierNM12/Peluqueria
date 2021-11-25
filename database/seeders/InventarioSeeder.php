<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventario;

class InventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inventario::create([
            'id' => '1',
            'productos_id' => '1',
            'proveedores_id' => '1',
            'precio' => '14',
        ]);
    }
}
