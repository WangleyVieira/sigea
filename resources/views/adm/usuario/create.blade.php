<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>SIGEA</title>
  <link rel="shortcut icon" type="svg" href="{{ asset('image/layer-group-solid.svg') }}" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
  <link rel="stylesheet" href="{{ asset('css/auth-modern.css') }}">
</head>
<body>
  <div class="auth-shell">
    <div class="auth-grid">
      <aside class="auth-brand">
        <span class="brand-tag"><i class="fas fa-user-plus"></i> Cadastro</span>
        <h1>Crie sua conta no SIGEA</h1>
        <p>Depois do cadastro, voce poderá montar e gerenciar suas atividades de forma pratica e organizada.</p>
      </aside>

      <section class="auth-panel">
        <div class="panel-header">
          <h2>Cadastrar</h2>
          <p>Preencha os dados abaixo para criar seu acesso.</p>
        </div>

        <form action="{{ route('salvar_usuario_externo') }}" method="POST" id="form" class="form_prevent_multiple_submits mt-2">
          @csrf
          @method('POST')

          @include('errors.alerts')

          <div class="field">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" placeholder="Informe seu nome" value="{{ old('nome') }}" required>
            @error('nome')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="field">
            <label for="email">E-mail</label>
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Informe seu e-mail" value="{{ old('email') }}" required>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="field">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Informe a senha" required>
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="field">
            <label for="confirmacao">Confirmar senha</label>
            <input type="password" name="confirmacao" id="confirmacao" class="form-control @error('confirmacao') is-invalid @enderror" placeholder="Confirme sua senha" required>
            @error('confirmacao')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="password-tip">Use uma senha com pelo menos 6 caracteres.</div>

          <button type="submit" class="btn-auth">Cadastrar</button>
          <a href="{{ route('login') }}" class="btn-secondary-link">Voltar para login</a>
        </form>
      </section>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ url('js/bootstrap.js') }}"></script>
  <script src="{{ url('js/prevent_multiple_submits.js') }}"></script>
</body>
</html>


