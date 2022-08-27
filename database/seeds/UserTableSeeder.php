<?php

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
            ['name' => 'Sigea', 'email' => 'sigea@gmail.com', 'password' => Hash::make('sigea2022@'), 'id_perfil' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10']
        ]);
    }
}
