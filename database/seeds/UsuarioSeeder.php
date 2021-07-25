<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => 'Prueba',
        //     'email' => 'prueba@prueba.com',
        //     'password' => Hash::make('password'),
        //     'url' => 'wwww.prueba.com',
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'Javi',
        //     'email' => 'javi@javi.com',
        //     'password' => Hash::make('password'),
        //     'url' => 'wwww.javi.com',
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);

        $user = User::create([
            'name' => 'Javi',
            'email' => 'javi@javi.com',
            'password' => Hash::make('password'),
            'url' => 'wwww.javi.com',
            'rango' => 'admin'
        ]);
        // $user->perfil()->create();

        $user1 = User::create([
            'name' => 'Prueba',
            'email' => 'prueba@prueba.com',
            'password' => Hash::make('password'),
            'url' => 'wwww.prueba.com',
            'rango' => 'moderator'
        ]);
        // $user1->perfil()->create();
    }
}
