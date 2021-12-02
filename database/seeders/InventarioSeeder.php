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
        for ($i=0; $i < 5; $i++) { 
            Inventario::create([
                'productos_id' => '1',
                'proveedores_id' => '1',
                'precio' => '14.00',
            ]);
        }

        for ($i=0; $i < 5; $i++) { 
            Inventario::create([
                'productos_id' => '2',
                'proveedores_id' => '1',
                'precio' => '14.00',
            ]);
        }

        for ($i=0; $i < 5; $i++) { 
            Inventario::create([
                'productos_id' => '3',
                'proveedores_id' => '2',
                'precio' => '14.00',
            ]);
        }
    }
}
