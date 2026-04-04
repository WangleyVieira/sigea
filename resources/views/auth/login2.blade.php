<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
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
        <span class="brand-tag"><i class="fas fa-layer-group"></i> SIGEA</span>
        <h1>Sistema de Geração de Atividades</h1>
        <p>Organize disciplinas, questões e atividades com mais eficiência em uma plataforma simples e centralizada.</p>
      </aside>

      <section class="auth-panel">
        <div class="panel-header">
          <h2>Entrar</h2>
          <p>Use suas credenciais para acessar o sistema.</p>
        </div>

        <form action="{{ route('login.autenticacao') }}" method="POST" class="mt-3">
          @csrf
          @method('POST')

          @include('errors.alerts')
          @include('errors.errors')

          <div class="field">
            <label for="email">E-mail</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Digite seu e-mail" value="{{ old('email') }}" required>
          </div>

          <div class="field">
            <label for="password">Senha</label>
            <div class="password-wrap">
              <input type="password" name="password" id="password" class="form-control" placeholder="Digite sua senha" required>
              <button type="button" class="password-toggle" id="togglePassword" aria-label="Mostrar senha">
                <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>

          <button type="submit" class="btn-auth">Entrar</button>
          <a href="{{ route('registrar_usuario') }}" class="btn-secondary-link">Criar cadastro</a>

          <div class="panel-footer">
            &copy; {{ date('Y') }} SIGEA
          </div>
        </form>
      </section>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ url('js/bootstrap.js') }}"></script>
  <script>
    document.getElementById('togglePassword').addEventListener('click', function () {
      var input = document.getElementById('password');
      var icon = this.querySelector('i');
      var isHidden = input.type === 'password';
      input.type = isHidden ? 'text' : 'password';
      icon.className = isHidden ? 'fas fa-eye-slash' : 'fas fa-eye';
    });
  </script>
</body>
</html>


