<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Clientes;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clientes::create([
            'id' => '1',
            'nombre' => 'Javier',
            'apellidos' => 'Núñez Morales',
            'telefono' => '123123123',
            'descripcion' => 'Le gusta el corte de pelo corto, tinte 255/153/204',
        ]);
    }
}
