<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisciplinaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('disciplinas')->insert([
            // primeiro semestre
            // 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'

            ['nome' => 'Fundamentos Matemáticos', 'codigo' => 'MA41A', 'id_periodo' => 1, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Comunicação Linguística' , 'codigo' => 'LP41B', 'id_periodo' => 1, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Lógica Digital', 'codigo' => 'SI41C', 'id_periodo' => 1,'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Organização de Empresas', 'codigo' => 'GT41D', 'id_periodo' => 1, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Algoritmos' , 'codigo' => 'SI41E', 'id_periodo' => 1, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Construção de Páginas Web I', 'codigo' => 'SI41F', 'id_periodo' => 1, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],

            // segundo semestre
            ['nome' => 'Inglês Instrumental' , 'codigo' => 'LE42A', 'id_periodo' => 2, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Metodologia da Pesquisa Científica' , 'codigo' => 'SI42B', 'id_periodo' => 2, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Banco de Dados I' , 'codigo' => 'SI42C', 'id_periodo' => 2, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Análise e Projeto Orientado a Objetos', 'codigo' => 'SI42D', 'id_periodo' => 2, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Engenharia de Software I' , 'codigo' => 'SI42E', 'id_periodo' => 2, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Organização e Arquitetura de Computadores' , 'codigo' => 'SI42F', 'id_periodo' => 2, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Linguagem de Programação I', 'codigo' => 'SI42G', 'id_periodo' => 2, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],

            //terceiro semestre
            ['nome' => 'Sistemas Operacionais', 'codigo' => 'SI43A', 'id_periodo' => 3, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Redes de Computadores I', 'codigo' => 'SI43B', 'id_periodo' => 3, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Engenharia de Software II', 'codigo' => 'SI43C', 'id_periodo' => 3, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Banco de Dados II', 'codigo' => 'SI43D', 'id_periodo' => 3, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Construção de Páginas Web II', 'codigo' => 'SI43E', 'id_periodo' => 3, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Linguagem de Programação II', 'codigo' => 'SI43F', 'id_periodo' => 3, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Estrutura de Dados', 'codigo' => 'SI43G', 'id_periodo' => 3, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],

            //quarto semestre
            ['nome' => 'Estatística', 'codigo' => 'MA44A', 'id_periodo' => 4, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Projeto Integrador I', 'codigo' => 'SI44B', 'id_periodo' => 4, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Empreendedorismo', 'codigo' => 'GT44C', 'id_periodo' => 4, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Interação Homem-Computador', 'codigo' => 'SI44D', 'id_periodo' => 4, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Redes de Computadores II', 'codigo' => 'SI44E', 'id_periodo' => 4, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Segurança e Auditoria de Sistemas', 'codigo' => 'SI44F', 'id_periodo' => 4, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Construção de Páginas Web III', 'codigo' => 'SI44G', 'id_periodo' => 4, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Linguagem de Programação III', 'codigo' => 'SI44H', 'id_periodo' => 4, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],

            //quinto semestre
            ['nome' => 'Filosofia da Ciência e Tecnologia', 'codigo' => 'SI45A', 'id_periodo' => 5, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Sistema de Informação e E-Commerce', 'codigo' => 'SI45B', 'id_periodo' => 5, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Sistemas Distribuídos', 'codigo' => 'SI45C', 'id_periodo' => 5, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Programação para Dispositivos Móveis', 'codigo' => 'SI45D', 'id_periodo' => 5, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Gerência e Configuração de Serviços de Internet', 'codigo' => 'SI45E', 'id_periodo' => 5, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Linguagem de Programação IV', 'codigo' => 'SI45F', 'id_periodo' => 5, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'WebServices e XML', 'codigo' => 'SI45G', 'id_periodo' => 5, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Projeto Integrador II', 'codigo' => 'SI45I', 'id_periodo' => 5, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            //Curricular eletiva
            ['nome' => 'Libras', 'codigo' => 'SI45I', 'id_periodo' => 5, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],
            ['nome' => 'Projeto de Redes', 'codigo' => 'SI45I', 'id_periodo' => 5, 'cadastradoPorUsuario' => 1, 'ativo' => 1, 'created_at' => '2022-06-29 22:50:10', 'updated_at' => '2022-06-29 22:50:10'],

        ]);
    }
}
