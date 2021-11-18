<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Productos;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Productos::create([
            'id' => '1',
            'nombre' => 'Tinte rojo',
            'existencias' => '10',
            'minimo' => '12',
            'pvp' => '12.90',
            'tipo' => '1',
        ]);

        Productos::create([
            'id' => '2',
            'nombre' => 'Crema de manos marca X 100ml',
            'existencias' => '20',
            'minimo' => '5',
            'pvp' => '7.99',
            'tipo' => '1',
        ]);

        Productos::create([
            'id' => '3',
            'nombre' => 'Champú calidad premium 1L para peluquerías',
            'existencias' => '5',
            'minimo' => '2',
            'pvp' => '20',
            'tipo' => '0',
        ]);
    }
}
