<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfils')->insert([
            ['descricao'=>'Administrador', 'ativo'=>1],
            ['descricao'=>'Usuario', 'ativo'=>1],
        ]);
    }
}
