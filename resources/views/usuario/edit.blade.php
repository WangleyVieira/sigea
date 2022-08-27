@extends('layout.mainExterno')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.4/select2-bootstrap.min.css" integrity="sha512-eNfdYTp1nlHTSXvQD4vfpGnJdEibiBbCmaXHQyizI93wUnbCZTlrs1bUhD7pVnFtKRChncH5lpodpXrLpEdPfQ==" crossorigin="anonymous" />
<style>
    .error{
        color:red
    }
</style>
@include('errors.alerts')
@include('errors.errors')

<header class="container" style="padding: 3rem; background-color:white">
    <h2 class="text-center">
        <div>
            <span><i class="fas fa-address-book"></i></span>
        </div>
        <strong>Clientes</strong>
    </h2>
</header>

<div class="container" style="padding: 3rem; background-color:white">
    <h3 class="text-center">Alteração de Cliente</h3>
    <div class="card">
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion2">
            <div class="card-body">
                <form action="{{ route('usuario.update', $user->id) }}" id="form" method="POST" class="form_prevent_multiple_submits">
                    @csrf
                    @method('POST')

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Dados Pessoais</h5>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="form-label">Nome</label>
                                    <input class="form-control form-control-lg" type="text" name="name" id="name" value="{{ $user->name }}" placeholder="Informe seu nome">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label">CPF</label>
                                    <input class="cpf form-control form-control-lg" type="text" name="cpf" id="cpf" value="{{ $user->cpf }}" placeholder="Informe seu CPF">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label">Email</label>
                                    <input class="form-control form-control-lg" type="email" name="email" value="{{ $user->email }}" placeholder="Informe um email válido">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="uf">UF</label>
                                    <select name="uf" id="uf" class="form-control form-control-lg select2" required>
                                        @if ($user->id_estado != null)
                                            <option value="{{ $user->id_estado }}" selected>{{ $user->estado->sigla }}</option>
                                        @else
                                            <option value="" selected disabled>Selecione o estado</option>
                                        @endif
                                        @foreach ($estados as $estado)
                                            <option value="{{ $estado->id }}">{{ $estado->sigla }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_municipio">Município</label>
                                    <select name="id_municipio" id="id_municipio" class="form-control form-control-lg select2" required>
                                        @if ($user->id_municipio != null)
                                            <option value="{{ $user->id_municipio }}" selected>{{ $user->municipio->descricao }}</option>
                                        @else
                                            <option value="" selected disabled>Selecione o município</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label">Senha (mínimo 6 caracteres)</label>
                                    <input class="form-control form-control-lg" type="password" name="password" placeholder="Informe uma senha">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label">Confirme a senha (mínimo 6 caracteres)</label>
                                    <input class="form-control form-control-lg" type="password" name="confirmacao" placeholder="Confirme a senha">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Endereço</h5>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="cep">CEP</label>
                                    <input type="text" name="cep" id="cep" value="{{ $user->cep }}" class="form-control form-control-lg" placeholder="Informe o CEP">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="endereco">Endereço (Rua/Avenida)</label>
                                    <input type="text" name="endereco" id="endereco" value="{{ $user->endereco }}" class="form-control form-control-lg" placeholder="Informe o endereço">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="numero">Número</label>
                                    <input type="text" name="numero" id="numero" value="{{ $user->numero }}" class="form-control form-control-lg" placeholder="Informe o número">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" name="bairro" id="bairro" value="{{ $user->bairro }}" class="form-control form-control-lg" placeholder="Informe o bairro">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="complemento">Complemento</label>
                                    <input type="text" name="complemento" id="complemento" value="{{ $user->complemento }}" class="form-control form-control-lg" placeholder="Informe o complemento">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="ponto_referencia">Ponto de Referência</label>
                                    <input type="text" name="ponto_referencia" value="{{ $user->ponto_referencia }}" class="form-control form-control-lg" placeholder="Informe o ponto de referência">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="container-fluid">
                        <button type="submit" class="button_prevent_multiple_submits btn btn-primary">Salvar</button>
                        <a href="{{ URL::previous() }}" class="btn btn-light">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/datatables.js') }}"></script>
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{asset('jquery-mask/src/jquery.mask.js')}}"></script>
<script>
    $('#cep').mask('00.000-000');
    $('.cpf').mask('000.000.000-00');

    $('#cep').on('change', function(){
        var cep = $(this).val().replace(/[.-]/g,"");
        // console.log('CEP: ', cep);
        // console.log('Quantidade de caracteres: ', cep.length);
        if (cep.length != 8){
            $("#endereco").val('');
            $("#complemento").val('');
            $("#bairro").val('');
            // $("#cidade").val('');
            // $("#uf").val('');
            alert('CEP INVÁLIDO!');
        }
        else{
            $.ajax({
                //O campo URL diz o caminho de onde virá os dados
                //É importante concatenar o valor digitado no CEP
                url: 'https://viacep.com.br/ws/'+cep+'/json/',
                //Aqui você deve preencher o tipo de dados que será lido,
                //no caso, estamos lendo JSON.
                dataType: 'json',
                //SUCESS é referente a função que será executada caso
                //ele consiga ler a fonte de dados com sucesso.
                //O parâmetro dentro da função se refere ao nome da variável
                //que você vai dar para ler esse objeto.
                success: function(resposta){
                    //Agora basta definir os valores que você deseja preencher
                    //automaticamente nos campos acima.
                    $("#endereco").val(resposta.logradouro);
                    $("#complemento").val(resposta.complemento);
                    $("#bairro").val(resposta.bairro);
                    // $("#cidade").val(resposta.localidade);
                    // $("#uf").val(resposta.uf);
                    //Vamos incluir para que o Número seja focado automaticamente
                    //melhorando a experiência do usuário
                    if (resposta.logradouro != null && resposta.logradouro != ""){
                        $("#numero").focus();
                    }
                    else{
                        $("#endereco").focus();
                    }
                },
                error: function(resposta){
                    //Agora basta definir os valores que você deseja preencher
                    //automaticamente nos campos acima.
                    alert("Erro, CEP inválido");
                    $("#endereco").val('');
                    $("#complemento").val('');
                    $("#bairro").val('');
                    // $("#cidade").val('');
                    // $("#uf").val('');
                    //Vamos incluir para que o Número seja focado automaticamente
                    //melhorando a experiência do usuário
                    $("#cep").focus();
                },
            });
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
                // $('select[name=id_nucleo]').empty();
                $.each(municipios,
                    function(key, value) {
                        if (b){
                            $('select[name=id_municipio]').append('<option value="" selected disabled>Selecione um município</option>');
                            // $('select[name=id_nucleo]').append('<option value="" selected disabled>Selecione um programa</option>');
                        }
                        b = false;
                        $('select[name=id_municipio]').append('<option value=' + value.id +
                            '>' + value.descricao + '</option>');
                    });
            });
        });
    });

</script>

@endsection
