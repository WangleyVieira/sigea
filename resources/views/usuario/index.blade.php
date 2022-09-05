<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIGEA</title>
    <link rel="shortcut icon" type="svg" href="{{ asset('image/layer-group-solid.svg') }}" style="color: #4a88eb">

    <link rel="shortcut icon" type="svg" href="{{ asset('image/layer-group-solid.svg') }}" style="color: #4a88eb">
    <link rel="shortcut icon" type="svg" href="{{ asset('image/layer-group-solid.svg') }}" style="color: #4a88eb">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.0/r-2.2.9/rr-1.2.8/datatables.min.css"/>
    <link href="{{asset('select2-4.1.0/dist/css/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('select2-bootstrap/dist/select2-bootstrap.css')}}"/>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/html5-qrcode.min.js') }}"></script>

    <style>
        .error{
              color:red
        }
        #footer{
            background-color: rgb(148, 206, 148);
        }
    </style>
</head>
<body>
    <div class="main d-flex justify-content-center w-100">
        <main class="content d-flex p-0">
            <div class="container d-flex flex-column">
                <div class="row h-100">
                    <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                        <div class="d-table-cell align-middle">
                            <div class="text-center mt-4">
                                <h1 class="h2">
                                    Cadastrar usuário
                                </h1>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="m-sm-4">
                                        <form action="{{route('salvar_usuario')}}" method="POST" id="form" class="form_prevent_multiple_submits">
                                            @csrf
                                            @method('POST')
                                            @include('errors.alerts')
                                            @include('errors.errors')
                                            <div class="mb-3">
                                                <label for="text">Nome</label>
                                                <input type="text" name="nome" id="nome" class="form-control form-control-lg" placeholder="Informe seu nome">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email">E-mail</label>
                                                <input type="text" name="email" id="email" class="form-control form-control-lg" placeholder="Digite seu e-mail">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password">Senha</label>
                                                <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Digite sua senha">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password">Confirme novamente a senha</label>
                                                <input type="password" name="confirmacao" id="confirmacao" class="form-control form-control-lg" placeholder="Confirme novamente a senha">
                                            </div>
                                            <div class="mt-3">
                                                <button type="submit" class="btn btn-lg btn-outline-primary" style="width: 100%">Cadastrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="footer" id="footer">
            <div class="container-fluid">
                <div class="row text-muted">
                    <div class="col-6 text-left">
                        <p class="mb-0">
                            &copy; <b>2022 - SIGEA - Sistema de Geração de Atividades</b>
                        </p>
                    </div>
                    <div class="col-6 text-right">
                        <p class="mb-0">
                            <a href="https://adminkit.io/" target="_blank" class="text-muted"><strong> &copy; AdminKit - Free & Premium Bootstrap 5 Admin Template</strong></a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

{{-- Scripts --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('jquery-mask/dist/jquery.mask.min.js')}}"></script>
<script src="{{ url('js/fontawesome.js') }}"></script>
<script src="{{ url('js/bootstrap.js') }}"></script>
<script src="{{asset('js/jquery.validate.js')}}"></script>
<script src="{{ url('js/functions.js') }}"></script>
<script src="{{ url('js/prevent_multiple_submits.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.0/r-2.2.9/rr-1.2.8/datatables.min.js"></script>
<script src="{{asset('select2-4.1.0/dist/js/select2.min.js')}}"></script>
@yield('scripts')
<script>
    $("#form").validate({
        rules: {
            nome:{
                required:true,
                maxlength:255,
            },
            email:{
                required:true,
                maxlength:255,
            },
            password:{
                required:true,
                minlength:6,
            },
            confirmacao:{
                required:true,
                minlength:6,
            },
        },

        messages: {
            nome:{
                required:"Campo obrigatório",
                maxlength:"Máximo de 255 caracteres"
            },
            email:{
                required:"Campo obrigatório",
                maxlength:"Máximo de 255 caracteres"
            },
            password:{
                required:"Campo obrigatório",
                minlength:"Minímo 6 caracteres"
            },
            confirmacao:{
                required:"Campo obrigatório",
                minlength:"Minímo 6 caracteres"
            },
        }
    });
</script>

</body>
</html>


