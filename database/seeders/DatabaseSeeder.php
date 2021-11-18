<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            ProveedorSeeder::class,
            ProductoSeeder::class,
            ProductoProveedorSeeder::class,
            HistoricoSeeder::class,
            ClienteSeeder::class,
            ServicioSeeder::class,
            CitaSeeder::class,
            CitaServicioSeeder::class,
        ]);
    }
}
