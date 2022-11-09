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

            //Redes de Computadores
            ['descricao' => 'Componentes básicos de uma Rede de Computadores', 'id_disciplina' => 15, 'ativo' => 1],
            ['descricao' => 'Arquitetura de Redes de Computadores', 'id_disciplina' => 15, 'ativo' => 1],
            ['descricao' => 'Topologia de Redes de Computadores', 'id_disciplina' => 15, 'ativo' => 1],
            ['descricao' => 'Interligação de Redes de Computadores', 'id_disciplina' => 15, 'ativo' => 1],

            //Engenharia de Software II
            ['descricao' => 'Conceitos sobre Qualidade', 'id_disciplina' => 16, 'ativo' => 1],
            ['descricao' => 'Certificação de Qualidade', 'id_disciplina' => 16, 'ativo' => 1],
            ['descricao' => 'Qualidade de Software', 'id_disciplina' => 16, 'ativo' => 1],
            ['descricao' => 'Qualidade de Produtos de Software', 'id_disciplina' => 16, 'ativo' => 1],

            //Banco de Dados II
            ['descricao' => 'Normalização', 'id_disciplina' => 17, 'ativo' => 1],
            ['descricao' => 'Decomposição de consultas e localização de dados', 'id_disciplina' => 17, 'ativo' => 1],
            ['descricao' => 'OLAP e otimização de consultas', 'id_disciplina' => 17, 'ativo' => 1],
            ['descricao' => 'Gerenciamento de transações', 'id_disciplina' => 17, 'ativo' => 1],

            //Contrução de Páginas Web II
            ['descricao' => 'Linguagens de script de página', 'id_disciplina' => 18, 'ativo' => 1],
            ['descricao' => 'Formulários e dados', 'id_disciplina' => 18, 'ativo' => 1],
            ['descricao' => 'Padrões de layout', 'id_disciplina' => 18, 'ativo' => 1],
            ['descricao' => 'Programação web orientada a objetos', 'id_disciplina' => 18, 'ativo' => 1],

            //Linguagem de Programação II
            ['descricao' => 'Tratamento de exceções', 'id_disciplina' => 19, 'ativo' => 1],
            ['descricao' => 'Bibliotecas mais utilizadas da linguagem', 'id_disciplina' => 19, 'ativo' => 1],
            ['descricao' => 'Manipulação de arquivos', 'id_disciplina' => 19, 'ativo' => 1],

            //Estrutura de Dados
            ['descricao' => 'Representação e Manipulação de Informações', 'id_disciplina' => 20, 'ativo' => 1],
            ['descricao' => 'Tipos Abstratos de Dados: Conceitos e Aplicações', 'id_disciplina' => 20, 'ativo' => 1],
            ['descricao' => 'Algoritmos de Classificação', 'id_disciplina' => 20, 'ativo' => 1],

            //Estatística
            ['descricao' => 'Estatística Descritiva', 'id_disciplina' => 21, 'ativo' => 1],
            ['descricao' => 'Variáveis Aleatórias Discretas e Contínuas', 'id_disciplina' => 21, 'ativo' => 1],
            ['descricao' => 'Distribuições de Probabilidade', 'id_disciplina' => 21, 'ativo' => 1],

            //Projeto Integrador
            ['descricao' => 'Elaboração de proposta de trabalho científico e/ou tecnológico envolvendo temas abrangidos pelo curso', 'id_disciplina' => 22, 'ativo' => 1],

            //Empreendedorismo
            ['descricao' => 'O mercado de trabalho atual', 'id_disciplina' => 23, 'ativo' => 1],
            ['descricao' => 'As bases da empregabilidade', 'id_disciplina' => 23, 'ativo' => 1],
            ['descricao' => 'Empreendedorismo', 'id_disciplina' => 23, 'ativo' => 1],
            ['descricao' => 'Plano de negócio', 'id_disciplina' => 23, 'ativo' => 1],

            //Interação Homem-Computador
            ['descricao' => 'Fundamentos de IHC', 'id_disciplina' => 24, 'ativo' => 1],
            ['descricao' => 'Diretrizes para o Design de interfaces', 'id_disciplina' => 24, 'ativo' => 1],
            ['descricao' => 'Construção e Avaliação de projeto IHC.', 'id_disciplina' => 24, 'ativo' => 1],
            ['descricao' => 'Paradigmas da Comunicação IHC', 'id_disciplina' => 24, 'ativo' => 1],
            ['descricao' => 'Teste de Usabilidade', 'id_disciplina' => 24, 'ativo' => 1],

            //Redes de Computadores II
            ['descricao' => 'Protocolos de roteamento', 'id_disciplina' => 25, 'ativo' => 1],
            ['descricao' => 'Redes locais Wireless', 'id_disciplina' => 25, 'ativo' => 1],
            ['descricao' => 'Frame Relay', 'id_disciplina' => 25, 'ativo' => 1],

            //Segurança e Auditoria de Sistemas
            ['descricao' => 'Conceitos de auditoria', 'id_disciplina' => 26, 'ativo' => 1],
            ['descricao' => 'Auditoria de sistemas e a área de sistemas de informação', 'id_disciplina' => 26, 'ativo' => 1],
            ['descricao' => 'Segurança em sistemas na Internet', 'id_disciplina' => 26, 'ativo' => 1],
            ['descricao' => 'Softwares de auditoria', 'id_disciplina' => 26, 'ativo' => 1],

            //Contrução de Páginas Web III
            ['descricao' => 'Construção dinâmica de páginas web', 'id_disciplina' => 27, 'ativo' => 1],
            ['descricao' => 'Construção dinâmica de menus de seleção', 'id_disciplina' => 27, 'ativo' => 1],
            ['descricao' => 'Manipulação de arquivos', 'id_disciplina' => 27, 'ativo' => 1],
            ['descricao' => 'Conexão com bancos de dados', 'id_disciplina' => 27, 'ativo' => 1],

            //Linguagem de Programação III
            ['descricao' => 'Interfaces e classes abstratas', 'id_disciplina' => 28, 'ativo' => 1],
            ['descricao' => 'Acesso a bancos de dados relacionais', 'id_disciplina' => 28, 'ativo' => 1],
            ['descricao' => 'Modelos de mapeamento objetorelacional', 'id_disciplina' => 28, 'ativo' => 1],

            //Filosofia da Ciência e Tecnologia
            ['descricao' => 'Método Científico', 'id_disciplina' => 29, 'ativo' => 1],
            ['descricao' => 'Positivismo Lógico', 'id_disciplina' => 29, 'ativo' => 1],
            ['descricao' => 'Falseabilidade', 'id_disciplina' => 29, 'ativo' => 1],

            //Sistemas de Informação e E-commerce
            ['descricao' => 'Os aspectos, os objetos e as relações da informação', 'id_disciplina' => 30, 'ativo' => 1],
            ['descricao' => 'Dados e informações', 'id_disciplina' => 30, 'ativo' => 1],
            ['descricao' => 'Qualidade da informação', 'id_disciplina' => 30, 'ativo' => 1],

            //Sistemas Distribuídos
            ['descricao' => 'Comunicação e sincronização em sistemas distribuídos', 'id_disciplina' => 31, 'ativo' => 1],
            ['descricao' => 'Protocolos', 'id_disciplina' => 31, 'ativo' => 1],
            ['descricao' => 'Sistemas operacionais distribuídos e de rede', 'id_disciplina' => 31, 'ativo' => 1],
            ['descricao' => 'Transações e dados compartilhados', 'id_disciplina' => 31, 'ativo' => 1],

            //Programação para Dispositivos Móveis
            ['descricao' => 'Introdução à computação móvel', 'id_disciplina' => 32, 'ativo' => 1],
            ['descricao' => 'Projeto de interfaces para dispositivos móveis', 'id_disciplina' => 32, 'ativo' => 1],
            ['descricao' => 'Bancos de dados para dispositivos móveis', 'id_disciplina' => 32, 'ativo' => 1],

            //Gerência e Configuração de Serviços de Internet
            ['descricao' => 'Instalação e implantação de redes Windows', 'id_disciplina' => 33, 'ativo' => 1],
            ['descricao' => 'Servidores WINS', 'id_disciplina' => 33, 'ativo' => 1],
            ['descricao' => 'Integração de sistemas Windows/Linux', 'id_disciplina' => 33, 'ativo' => 1],

            //Linguagem de Programação IV
            ['descricao' => 'Características avançadas de programação', 'id_disciplina' => 34, 'ativo' => 1],
            ['descricao' => 'Extensões para programação web', 'id_disciplina' => 34, 'ativo' => 1],
            ['descricao' => 'Integração entre aplicações desktop e web com acesso a banco de dados', 'id_disciplina' => 34, 'ativo' => 1],

            //Webservices e XML
            ['descricao' => 'Sintaxe XML', 'id_disciplina' => 35, 'ativo' => 1],
            ['descricao' => 'Schema XML', 'id_disciplina' => 35, 'ativo' => 1],
            ['descricao' => 'Transformação de XML', 'id_disciplina' => 35, 'ativo' => 1],

            //Projeto de Redes
            ['descricao' => 'Metodologia para Projeto de Redes de Computadores: Análise de Requisitos, Projeto Lógico, Projeto Físico', 'id_disciplina' => 36, 'ativo' => 1],
            ['descricao' => 'Estudo de Caso', 'id_disciplina' => 36, 'ativo' => 1],
            ['descricao' => 'Aplicações Práticas', 'id_disciplina' => 36, 'ativo' => 1],

            //Projeto Integrador II
            ['descricao' => 'Elaboração de proposta de trabalho científico e/ou tecnológico envolvendo temas abrangidos pelo curso', 'id_disciplina' => 37, 'ativo' => 1],

            //Libras
            ['descricao' => 'Apresentação e desenvolvimento da língua brasileira de sinais', 'id_disciplina' => 38, 'ativo' => 1],
            ['descricao' => 'O sujeito surdo em um mundo ouvinte', 'id_disciplina' => 38, 'ativo' => 1],
            ['descricao' => 'Familiarização do tecnólogo com o mundo da surdez', 'id_disciplina' => 38, 'ativo' => 1],


        ]);
    }
}
