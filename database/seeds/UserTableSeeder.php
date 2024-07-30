<?php

use App\Perfil;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Wangley',
                'email' => 'sigea@estudante.edu.com.br',
                'password' => Hash::make('sigea2022@'),
                'id_perfil' => Perfil::ADMIN,
                'ativo' => User::ATIVO,
                'created_at' => '2022-06-29 22:50:10',
                'updated_at' => '2022-06-29 22:50:10'
            ]
        ]);
    }
}
