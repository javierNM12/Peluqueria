<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PARA EJECUTAR EL SEEDER-> php artisan migrate:fresh --seed
        // WEB TUTORIAL -> https://laravel.com/docs/8.x/seeding
        User::create([
            'name' => 'yadira',
            'apellidos' => 'peluqueria',
            'email' => 'yadira@peluqueria.com',
            'password' => bcrypt('yadira'),
            'rol' => '1', // 1 -> empresa
        ]);

        User::create([
            'name' => 'admin',
            'apellidos' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'rol' => '0', // 0 -> admin
        ]);
/*
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10) . '@gmail.com',
            'password' => Hash::make('password'),
        ]);*/
    }
}
