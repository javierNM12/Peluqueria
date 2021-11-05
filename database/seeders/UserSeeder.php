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
            'name' => 'Javi',
            'apellidos' => 'Nunez',
            'email' => 'javi@javi.com',
            'password' => bcrypt('123patata'),
            'rol' => '1', // 0 -> admin (pero no muestra el navbar)
        ]);
/*
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10) . '@gmail.com',
            'password' => Hash::make('password'),
        ]);*/
    }
}
