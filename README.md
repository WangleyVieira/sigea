# SIGEA - Sistema de Geração de Atividades

Aplicacao web para cadastro, organização e compartilhamento de questões e atividades academicas.

O SIGEA foi desenvolvido para apoiar o curso Superior de Tecnologia em Sistemas para Internet do IFMS, permitindo que docentes organizem questões por disciplina/topico e gerem atividades com impressao em PDF.

## Visao Geral

- Cadastro e manutenção de disciplinas e topicos
- Cadastro e compartilhamento de questões
- Montagem de atividades a partir de questões
- Geração de PDF de atividade e gabarito
- Relatorios gerenciais (administrador)
- Controle de acesso por perfil de usuario

## Perfis de Usuario

- `Administrador`
  - Gerencia usuarios, disciplinas, topicos, questões, atividades e relatórios
- `Usuario externo`
  - Pode cadastrar questões e atividades dentro das permissões do perfil

## Tecnologias

- PHP `^7.2.5`
- Laravel `^7.0`
- PostgreSQL (recomendado para este projeto)
- mPDF (geracao de PDF)
- Bootstrap + jQuery

## Requisitos

- PHP 7.2+ (recomendado PHP 7.4)
- Composer
- PostgreSQL
- Extensoes PHP comuns do Laravel (`mbstring`, `openssl`, `pdo`, `tokenizer`, `xml`, etc.)

## Instalacao

1. Clone o repositorio:

```bash
git clone https://github.com/WangleyVieira/sigea.git
cd sigea
```

2. Instale as dependências PHP:

```bash
composer install
```

3. Copie o arquivo de ambiente:

```bash
cp .env.example .env
```

No Windows (PowerShell):

```powershell
Copy-Item .env.example .env
```

4. Gere a chave da aplicacao:

```bash
php artisan key:generate
```

## Configuracao do Banco

Edite o arquivo `.env` com as credenciais do seu banco.

### Exemplo com PostgreSQL (recomendado)

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=sigea
DB_USERNAME=postgres
DB_PASSWORD=sua_senha
```

### Exemplo com MySQL (alternativo)

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sigea
DB_USERNAME=root
DB_PASSWORD=sua_senha
```

## Migracoes e Seeds

Execute as migrações com dados iniciais:

```bash
php artisan migrate:fresh --seed
```

Isso cria perfis, usuario administrador padrao, periodos, disciplinas e topicos iniciais.

## Executando o Projeto

Inicie o servidor local:

```bash
php artisan serve
```

A aplicacao ficara disponivel em:

- `http://127.0.0.1:8000`
- `http://localhost:8000`

## Acesso Inicial (seed)

A seed cria um usuario administrador:

- Email: `sigea@estudante.edu.com.br`
- Senha: `sigea2022@`

Arquivo de referencia: `database/seeds/UserTableSeeder.php`

## Comandos Uteis

Limpar caches:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

Rodar testes (quando aplicavel):

```bash
php artisan test
```

## Contribuicao

1. Faça um fork
2. Crie uma branch: `git checkout -b feat/minha-melhoria`
3. Commit: `git commit -m "feat: minha melhoria"`
4. Push: `git push origin feat/minha-melhoria`
5. Abra um Pull Request

## Licenca

Este projeto esta sob a licenca MIT.

## Autor

SIGEA desenvolvido por Wangley Vieira.
