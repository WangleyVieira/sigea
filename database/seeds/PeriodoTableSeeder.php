<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('periodos')->insert([
            ['descricao' => '1º semestre', 'cadastradoPorUsuario' => 1, 'ativo' => 1],
            ['descricao' => '2º semestre', 'cadastradoPorUsuario' => 1, 'ativo' => 1],
            ['descricao' => '3º semestre', 'cadastradoPorUsuario' => 1, 'ativo' => 1],
            ['descricao' => '4º semestre', 'cadastradoPorUsuario' => 1, 'ativo' => 1],
            ['descricao' => '5º semestre', 'cadastradoPorUsuario' => 1, 'ativo' => 1]
        ]);
    }
}
