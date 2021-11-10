<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proveedores;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proveedores::create([
            'id' => '1',
            'telefono' => '123456789',
            'nombre' => 'Proveedor 1',
            'web' => 'www.web.com',
        ]);
    }
}
