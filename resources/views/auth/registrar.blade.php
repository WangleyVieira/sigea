<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>STIECSA</title>
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
    </style>

</head>
<body>
    <div class="main d-flex justify-content-center w-100">
        <nav class="navbar navbar-expand-md shadow-sm" style="background-color: #293042">
            <div class="container">
                <a class="sidebar-brand" href="{{ url('/') }}">
                    <span class="align-middle mr-3" style="font-size: .999rem;">STIECSA</span>
                </a>
            </div>
        </nav>
        <main class="content d-flex p-0">
            <div class="container d-flex flex-column">
                <div class="row h-100">
                    <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                        <div class="d-table-cell align-middle">
                            <div class="text-center mt-4">
                                <h1 class="h2">
                                    Registrar-se
                                </h1>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="m-sm-4">
                                        <form action="{{route('registrar_store')}}" method="POST" id="form" class="form_prevent_multiple_submits">
                                                @csrf
                                                @method('POST')
                                                @include('errors.alerts')
                                                @include('errors.errors')
                                                <div class="m-sm-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nome</label>
                                                        <input class="form-control form-control-lg" type="text" name="name" id="name" placeholder="Informe seu nome">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">CPF</label>
                                                        <input class="form-control form-control-lg" type="text" name="cpf" id="cpf" placeholder="Informe seu CPF">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input class="form-control form-control-lg" type="email" name="email" placeholder="Informe um email válido">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="uf">UF</label>
                                                        <select name="uf" id="uf" class="form-control select2" required>
                                                            <option value="" selected disabled>Selecione UF</option>
                                                            @foreach ($estados as $estado)
                                                                <option value="{{ $estado->id }}">{{ $estado->sigla }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="id_municipio">Município</label>
                                                            <select name="id_municipio" id="id_municipio" class="form-control select2" required>
                                                                <option value="" selected disabled>Selecione município</option>
                                                            </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Senha (mínimo 6 caracteres)</label>
                                                        <input class="form-control form-control-lg" type="password" name="password" placeholder="Informe uma senha">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Confirme a senha (mínimo 6 caracteres)</label>
                                                        <input class="form-control form-control-lg" type="password" name="confirmacao" placeholder="Confirme a senha">
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-lg btn-primary" style="width: 100%">Cadastrar</button>
                                                    </div>
                                                </div>
                                            {{-- <div class="text-center mt-2">
                                                <button type="submit" class="btn btn-lg btn-primary" style="width: 100%">Cadastrar</button>
                                            </div> --}}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row text-muted">
                    <div class="col-12 text-right">
                        <p class="mb-0">
                            &copy; 2022 - <a href="http://agile.inf.br" class="text-muted">Agile Tecnologia</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

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
    $('#cpf').mask('000.000.000-00');

    $("#form").validate({
        rules : {
            name:{
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
        messages:{
            name:{
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

    $(document).ready(function() {

        $('.select2').select2({
            language: {
                noResults: function() {
                    return "Nenhum resultado encontrado";
                }
            },
            closeOnSelect: true,
            width: '100%',
        });

        $('#uf').on('change', function() {
            var b = true;
            var idEstado = $('#uf').select2("val");
            $.get("{{ route('municipio.busca-municipios', '') }}" + "/" + idEstado, function(municipios) {
                $('select[name=id_municipio]').empty();
                $.each(municipios,
                function(key, value) {
                    if (b){
                        $('select[name=id_municipio]').append('<option value="" selected disabled>Selecione um município</option>');
                    }
                    b = false;
                    $('select[name=id_municipio]').append('<option value=' + value.id +
                        '>' + value.descricao + '</option>');
                });
            });
        });
    });
</script>
</body>
</html>




