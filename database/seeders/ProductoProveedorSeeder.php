<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Productos_Proveedores;

class ProductoProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Productos_Proveedores::create([
            'id' => '1',
            'productos_id' => '1',
            'proveedores_id' => '1',
            'precio' => '16.77',
        ]);
    }
}
