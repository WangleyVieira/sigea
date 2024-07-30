
## Sobre o SIGEA (SISTEMA DE GERAÇÃO DE ATIVIDADES)
Desenvolvimento do sistema web SIGEA - Sistema de Geração de Atividades do curso Superior de Tecnologia em Sistemas para Internet do IFMS. No SIGEA os docentes podem cadastrar e compartilhar as questões no sistema de acordo com a disciplina e os tópicos relacionados no PPC (Projeto Pedagógico do Curso), e também as atividades vinculadas a uma disciplina. O sistema oferece a geração de PDFs para as atividades, além de diversos relatórios de gestão para o administrador do sistema. A implementação do sistema se dá através da Linguagem de Programação PHP junto com o Framework Laravel e com o Banco de Dados Relacional PostgreSQL.

## Tela de Login

![Login](public/img/readme/login.JPG)


## Dashboard administrador

![Dashboard](public/img/readme/dashboard-sigea.JPG)

## Índice

- [Pré-requisitos](#pré-requisitos)
- [Instalação](#instalação)
- [Configuração](#configuração)
- [Executando o Projeto](#executando-o-projeto)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Contribuição](#contribuição)
- [Licença](#licença)

## Pré-requisitos

Antes de começar, certifique-se de ter os seguintes requisitos atendidos:

- PHP (versão 7.3 ou superior)
- Composer
- PostGres
- Git

## Instalação

1. **Clone o repositório:**
    ```bash
    git clone https://github.com/WangleyVieira/sigea.git
    cd sigea
   ```

2. **Instale as dependências:**

    ```bash
    composer install
   ```

## Configuração

1. **Copie o arquivo de configuração .env.example para .env:**

   ```bash
    cp .env.example .env
   ```
2. **Gere a chave da aplicação:**

   ```bash
    php artisan key:generate
   ```
3. **Configure as informações do banco de dados no arquivo .env:**

   ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sigea
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha
   ```
4. **Execute as migrações e as seeders para criar as tabelas no banco de dados:**

   ```bash
    php artisan migrate:fresh --seed
   ```

## Executando o Projeto
Para iniciar o servidor de desenvolvimento, utilize o seguinte comando:

```bash
  php artisan serve
```

O projeto estará disponível no endereço http://localhost:8000.

## Tecnologias Utilizadas

- Laravel 7
- PHP
- Composer
- PostGres

## Contribuição

Contribuições são bem-vindas! Para contribuir, siga os passos abaixo:

1. Fork o repositório.
2. Crie uma nova branch com a sua feature: git checkout -b minha-feature
3. Commit suas mudanças: git commit -m 'feat: Minha nova feature'
4. Push para a branch: git push origin minha-feature
5. Abra um Pull Request.

## Licença

Este projeto está licenciado sob a Licença MIT. Veja o arquivo LICENSE para mais detalhes.

SIGEA desenvolvido por Wangley Vieira

```bash
Esse guia cobre todos os aspectos necessários para configurar e executar o projeto SIGEA utilizando Laravel 7, desde a clonagem do repositório até a instalação das dependências, configuração e execução do servidor de desenvolvimento. Além disso, inclui informações sobre tecnologias utilizadas, como contribuir e a licença do projeto.
```


