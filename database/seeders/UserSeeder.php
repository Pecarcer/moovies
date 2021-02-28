<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

        DB::table('users')->insert([
        'nick' => 'admin',
        'email' => 'admin@gmail.com',
        'email_verified_at' => now(),
        'password' => Hash::make("12345678"), // password
        'role'=> 'admin',
        'fullname' => 'José Carmona Cervera', 
        'remember_token' => 'rememberJCC',
        'avatar' => 'https://cdn.iconscout.com/icon/free/png-256/avatar-373-456325.png']);


        User::factory(5)->create();


        $this->command->info('Usuarios añadidos correctamente');
        }
        
}
