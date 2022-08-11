<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurricularEletivaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('curricular_eletivas')->insert([
            ['nome' => 'Libras', 'codigo' => 'SI45J', 'cadastradoPorUsuario' => 1, 'ativo' => 1],
            ['nome' => 'Projeto de Redes', 'codigo' => 'SI45H', 'cadastradoPorUsuario' => 1, 'ativo' => 1]
        ]);
    }
}
