<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topicos')->insert([
            //Fundamentos Matemáticos
            ['descricao' => 'Números reais', 'id_disciplina' => 1, 'ativo' => 1],
            ['descricao' => 'Equações Algébricas.', 'id_disciplina' => 1, 'ativo' => 1],
            ['descricao' => 'Funções reais de variável real.', 'id_disciplina' => 1, 'ativo' => 1],
            ['descricao' => 'Limites de funções reais', 'id_disciplina' => 1, 'ativo' => 1],

            //Comunicação Linguística
            ['descricao' => 'Noções básicas de comunicação e linguagem: funções da linguagem', 'id_disciplina' => 2, 'ativo' => 1],
            ['descricao' => 'Sustentabilidade e comunicação', 'id_disciplina' => 2, 'ativo' => 1],
            ['descricao' => 'Leitura e produção de textos escritos: gêneros do mundo acadêmico e profissional', 'id_disciplina' => 2, 'ativo' => 1],

            //Lógica Digital
            ['descricao' => 'Sistemas de Numeração', 'id_disciplina' => 3, 'ativo' => 1],
            ['descricao' => 'Códigos', 'id_disciplina' => 3, 'ativo' => 1],
            ['descricao' => 'Álgebra de Boole', 'id_disciplina' => 3, 'ativo' => 1],
            ['descricao' => 'Portas Lógicas.', 'id_disciplina' => 3, 'ativo' => 1],

            //Organização de Empresas
            ['descricao' => 'Introdução à administração', 'id_disciplina' => 4, 'ativo' => 1],
            ['descricao' => 'Análise das Funções Administrativas', 'id_disciplina' => 4, 'ativo' => 1],
            ['descricao' => 'Organizações e Sistemas Organizacionais', 'id_disciplina' => 4, 'ativo' => 1],
            ['descricao' => 'Recursos Humanos', 'id_disciplina' => 4, 'ativo' => 1],

            //Algoritmos
            ['descricao' => 'Definição de algoritmos', 'id_disciplina' => 5, 'ativo' => 1],
            ['descricao' => 'Formas de representação de algoritmos', 'id_disciplina' => 5, 'ativo' => 1],
            ['descricao' => 'Refinamentos sucessivos', 'id_disciplina' => 5, 'ativo' => 1],

            //Contrução de Páginas Web
            ['descricao' => 'Descrição do protocolo HTTP e suas funcionalidades', 'id_disciplina' => 6, 'ativo' => 1],
            ['descricao' => 'Linguagem de formatação HTML', 'id_disciplina' => 6, 'ativo' => 1],
            ['descricao' => 'Formulários HTML', 'id_disciplina' => 6, 'ativo' => 1],

            //Inglês Instrumental
            ['descricao' => 'Desenvolvimento das estratégias de leitura em Língua Inglesa', 'id_disciplina' => 7, 'ativo' => 1],
            ['descricao' => 'aplicando os princípios teóricos do ESP (English for Specific Purposes) baseado em gênero', 'id_disciplina' => 7, 'ativo' => 1],

            //Metodologia da Pesquisa Científica
            ['descricao' => 'A investigação científica e tecnológica', 'id_disciplina' => 8, 'ativo' => 1],
            ['descricao' => 'Fontes', 'id_disciplina' => 8, 'ativo' => 1],
            ['descricao' => 'Fontes primária e secundária', 'id_disciplina' => 8, 'ativo' => 1],
            ['descricao' => 'Préprojeto', 'id_disciplina' => 8, 'ativo' => 1],

            //Banco de Dados I
            ['descricao' => 'Conceitos básicos de um SGBD', 'id_disciplina' => 9, 'ativo' => 1],
            ['descricao' => 'Projeto de banco de dados', 'id_disciplina' => 9, 'ativo' => 1],
            ['descricao' => 'Aspectos de implementação dos SGBDs relacionais', 'id_disciplina' => 9, 'ativo' => 1],

            //Análise e Projeto Orientado a Objetos
            ['descricao' => 'Metodologias de desenvolvimento de software orientadas a objeto', 'id_disciplina' => 10, 'ativo' => 1],
            ['descricao' => 'Modelagem em nível de análise e projeto', 'id_disciplina' => 10, 'ativo' => 1],
            ['descricao' => 'Ferramentas de modelagem', 'id_disciplina' => 10, 'ativo' => 1],
            ['descricao' => 'Modelagem em nível de análise e projeto', 'id_disciplina' => 10, 'ativo' => 1],

            //Engenharia de Software I
            ['descricao' => 'Histórico e evolução da Engenharia de Software', 'id_disciplina' => 11, 'ativo' => 1],
            ['descricao' => 'Papel do Software', 'id_disciplina' => 11, 'ativo' => 1],
            ['descricao' => 'Características do Software', 'id_disciplina' => 11, 'ativo' => 1],
            ['descricao' => 'Ciclos de Vida', 'id_disciplina' => 11, 'ativo' => 1],

            //Organização e Arquitetura de Computadores
            ['descricao' => 'Unidade Aritmética: arquitetura, registros, funções, carry, funcionamento básico', 'id_disciplina' => 12, 'ativo' => 1],
            ['descricao' => 'Unidades de entrada e saída', 'id_disciplina' => 12, 'ativo' => 1],
            ['descricao' => 'Arquiteturas pipeline', 'id_disciplina' => 12, 'ativo' => 1],

            //Linguagem de Programação I
            ['descricao' => 'Conceitos iniciais de linguagem de programação', 'id_disciplina' => 13, 'ativo' => 1],
            ['descricao' => 'Estrutura de programas', 'id_disciplina' => 13, 'ativo' => 1],
            ['descricao' => 'Vetores e matrizes', 'id_disciplina' => 13, 'ativo' => 1],
            ['descricao' => 'Modularização', 'id_disciplina' => 13, 'ativo' => 1],

            //Sistemas Operacionais
            ['descricao' => 'Estrutura e conceitos básicos de Sistema Operacional', 'id_disciplina' => 14, 'ativo' => 1],
            ['descricao' => 'Monoprocessamento e Multiprocessamento', 'id_disciplina' => 14, 'ativo' => 1],
            ['descricao' => 'Conceitos de processos e threads', 'id_disciplina' => 14, 'ativo' => 1],
            ['descricao' => 'Gerenciamento de memória', 'id_disciplina' => 14, 'ativo' => 1],
        ]);
    }
}
