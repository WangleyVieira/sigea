<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>SIGEA</title>
  <!-- Font Awesome -->
<link
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
rel="stylesheet"
/>
<!-- Google Fonts -->
<link
href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
rel="stylesheet"
/>
<!-- MDB -->
<link
href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css"
rel="stylesheet"
/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
    crossorigin="anonymous"></script>

    {{-- Styles --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.0/r-2.2.9/rr-1.2.8/datatables.min.css"/>
</head>

<style>
    .divider:after,.divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }
    .h-custom {
        height: calc(100% - 73px);
    }
    a{
        color: white;
    }
    #rodape{
        background-color: green;
    }
    @media (max-width: 450px) {
            .h-custom {
            height: 100%;
        }
    }

</style>
<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
              <img src={{ asset('img/logo1-removebg-preview.png') }} class="img-fluid" style="width: 100%">
            </div>

            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form action="{{route('salvar_usuario_externo')}}" method="POST" id="form" class="form_prevent_multiple_submits">
                    @csrf
                    @method('POST')
                    {{-- @include('errors.alerts')
                    @include('errors.errors') --}}
                    <div class="mb-3">
                        <label for="text">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control form-control-lg @error('nome') is-invalid @enderror" placeholder="Informe seu nome" value="{{ old('nome') }}">
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div><br>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Informe e-mail" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div><br>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password">Senha</label>
                        <input type="password" name="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Informe a senha">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div><br>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password">Confirme novamente a senha</label>
                        <input type="password" name="confirmacao" id="confirmacao" class="form-control form-control-lg @error('confirmacao') is-invalid @enderror" placeholder="Confirme novamente a senha">
                        @error('confirmacao')
                            <div class="invalid-feedback">{{ $message }}</div><br>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-lg btn-outline-primary" style="width: 100%">Cadastrar</button>
                    </div>
                </form>
            </div>

          </div>
        </div>
    </section>

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>

{{-- Scripts --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ url('js/bootstrap.js') }}"></script>

</body>

</html>
