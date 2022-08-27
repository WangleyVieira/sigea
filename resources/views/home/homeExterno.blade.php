@extends('layout.mainExterno')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.4/select2-bootstrap.min.css" integrity="sha512-eNfdYTp1nlHTSXvQD4vfpGnJdEibiBbCmaXHQyizI93wUnbCZTlrs1bUhD7pVnFtKRChncH5lpodpXrLpEdPfQ==" crossorigin="anonymous" />
<style>
    .error{
          color:red
    }
</style>


@include('errors.alerts')
@include('errors.errors')

<div class="row">
    <div class="col-md-3 mr-3">
        <div class="card mb-3">
            <div class="card-header">
                <h4 class="mb-3">Detalhes do Perfil</h4>
            </div>
            <div class="card-body text-center">
                <img src="{{ asset('img/user-avatar2.png') }}" class="img-fluid rounded-circle mb-2" width="128" height="128">
                <div class="cpf text-muted mb-2">{{ $user->cpf }}</div>
                <h4 class="mb-2 underline"><strong>{{ $user->name }}</strong></h4>
                <h4 class="mb-0">{{ $user->email }}</h4>
                {{-- @if ($user->cliente_adm == 1)
                    @if ($pagamento == null)
                        <h5 class="mt-2 mb-0">
                            @if ($user->assinante->data_termino != null)
                                Fim do período de teste: <br> <strong style="color: black">{{ date('d/m/Y', strtotime($user->assinante->data_termino)) }}</strong>
                            @else
                                Não Registrado
                            @endif
                        </h5>
                    @endif
                @endif --}}
            </div>
            {{-- <hr class="my-0">
            <div class="card-body">
                <h4 class="mb-3">Acessos</h4>
                <div class="row">
                    <div class="h5 text-muted col-md-6 mb-0"><p>Documentos:</p></div>
                    <div class="h5 col-md-6 mb-0">
                        @if ($user->acesso_doc == null)
                            <p class="text-danger">Sem acesso</p>
                        @endif
                        @if ($user->acesso_doc == 1)
                            <p class="text-success">Acesso completo</p>
                        @endif
                        @if ($user->acesso_doc == 2)
                            <p class="text-success">Listar</p>
                        @endif
                        @if ($user->acesso_doc == 3)
                            <p class="text-success">Listar e Cadastrar</p>
                        @endif
                        @if ($user->acesso_doc == 4)
                            <p class="text-success">Listar, Cadastrar e Editar</p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="h5 text-muted col-md-6 mb-0"><p>Contatos:</p></div>
                    <div class="h5 col-md-6 mb-0">
                        @if ($user->acesso_cont == null)
                            <p class="text-danger">Sem acesso</p>
                        @endif
                        @if ($user->acesso_cont == 1)
                            <p class="text-success">Acesso completo</p>
                        @endif
                        @if ($user->acesso_cont == 2)
                            <p class="text-success">Listar</p>
                        @endif
                        @if ($user->acesso_cont == 3)
                            <p class="text-success">Listar e Cadastrar</p>
                        @endif
                        @if ($user->acesso_cont == 4)
                            <p class="text-success">Listar, Cadastrar e Editar</p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="h5 text-muted col-md-6 mb-0"><p>Usuários:</p></div>
                    <div class="h5 col-md-6 mb-0">
                        @if ($user->acesso_user == null)
                            <p class="text-danger">Sem acesso</p>
                        @endif
                        @if ($user->acesso_user == 1)
                            <p class="text-success">Acesso completo</p>
                        @endif
                        @if ($user->acesso_user == 2)
                            <p class="text-success">Listar</p>
                        @endif
                        @if ($user->acesso_user == 3)
                            <p class="text-success">Listar e Cadastrar</p>
                        @endif
                        @if ($user->acesso_user == 4)
                            <p class="text-success">Listar, Cadastrar e Editar</p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="h5 text-muted col-md-6 mb-0"><p>Títulos:</p></div>
                    <div class="h5 col-md-6 mb-0">
                        @if ($user->acesso_titulo == null)
                            <p class="text-danger">Sem acesso</p>
                        @endif
                        @if ($user->acesso_titulo == 1)
                            <p class="text-success">Acesso completo</p>
                        @endif
                        @if ($user->acesso_titulo == 2)
                            <p class="text-success">Listar</p>
                        @endif
                        @if ($user->acesso_titulo == 3)
                            <p class="text-success">Listar e Cadastrar</p>
                        @endif
                        @if ($user->acesso_titulo == 4)
                            <p class="text-success">Listar, Cadastrar e Editar</p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="h5 text-muted col-md-6 mb-0"><p>Estoques:</p></div>
                    <div class="h5 col-md-6 mb-0">
                        @if ($user->acesso_estoq == null)
                            <p class="text-danger">Sem acesso</p>
                        @endif
                        @if ($user->acesso_estoq == 1)
                            <p class="text-success">Acesso completo</p>
                        @endif
                        @if ($user->acesso_estoq == 2)
                            <p class="text-success">Listar</p>
                        @endif
                        @if ($user->acesso_estoq == 3)
                            <p class="text-success">Listar e Cadastrar</p>
                        @endif
                        @if ($user->acesso_estoq == 4)
                            <p class="text-success">Listar, Cadastrar e Editar</p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="m-auto" style="display: block">
                        <a class="btn btn-pill btn-info" href="{{ route('usergestor.edit', $user->id) }}">Editar</a>
                        <a class="btn btn-pill btn-primary" href="{{ route('usergestor.create') }}">Voltar</a>
                    </div>
                </div>
            </div>
            <hr class="my-0"> --}}
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-left mb-0 mt-2">Atualizar dados</h4>
                    </div>
                </div>
            </div>
            <hr class="my-0">
            <div class="card-body">
                <div class="col-md-12">
                    <form action="{{ route('acesso_externo.user.update', $user->id) }}" id="form" method="POST" class="form_prevent_multiple_submits">
                        @csrf
                        @method('POST')

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Dados Pessoais</h5>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="form-label">Nome</label>
                                        <input class="form-control form-control-lg" type="text" name="name" id="name" placeholder="Informe seu nome" value="{{ $user->name }}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="form-label">CPF</label>
                                        <input class="cpf form-control form-control-lg" type="text" name="cpf" id="cpf" placeholder="Informe seu CPF" value="{{ $user->cpf }}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="form-label">Email</label>
                                        <input class="form-control form-control-lg" type="email" name="email" placeholder="Informe um email válido" value="{{ $user->email }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="uf">UF</label>
                                        <select name="uf" id="uf" class="form-control form-control-lg select2" required>
                                            @if ($user->id_estado == null)
                                                <option value="" selected disabled>-- Selecione --</option>
                                            @endif
                                            @foreach ($estados as $estado)
                                                <option value="{{ $estado->id }}" {{ $estado->id == $user->id_estado ? 'selected' : '' }}>{{ $estado->sigla }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="id_municipio">Município</label>
                                        <select name="id_municipio" id="id_municipio" class="form-control form-control-lg select2" required>
                                            @if ($user->id_municipio == null)
                                                <option value="" selected disabled>-- Selecione --</option>
                                            @endif
                                            @foreach ($municipios as $municipio)
                                                <option value="{{ $municipio->id }}" {{ $municipio->id == $user->id_municipio ? 'selected' : '' }}>{{ $municipio->descricao }}</option>
                                            @endforeach
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
                                        <input type="text" name="cep" id="cep" class="form-control form-control-lg" placeholder="Informe o CEP" value="{{ $user->cep }}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="endereco">Endereço (Rua/Avenida)</label>
                                        <input type="text" name="endereco" id="endereco" class="form-control form-control-lg" placeholder="Informe o endereço" value="{{ $user->endereco }}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="numero">Número</label>
                                        <input type="text" name="numero" id="numero" class="form-control form-control-lg" placeholder="Informe o número" value="{{ $user->numero }}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="bairro">Bairro</label>
                                        <input type="text" name="bairro" id="bairro" class="form-control form-control-lg" placeholder="Informe o bairro" value="{{ $user->bairro }}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="complemento">Complemento</label>
                                        <input type="text" name="complemento" id="complemento" class="form-control form-control-lg" placeholder="Informe o complemento" value="{{ $user->complemento }}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="ponto_referencia">Ponto de Referência</label>
                                        <input type="text" name="ponto_referencia" class="form-control form-control-lg" placeholder="Informe o ponto de referência" value="{{ $user->ponto_referencia }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="button_prevent_multiple_submits btn btn-primary">Salvar</button>
                            </div>
                        </div>

                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('jquery-mask/src/jquery.mask.js')}}"></script>

<script>
    $('.cpf').mask('000.000.000-00');
    $('#cep').mask('00.000-000');

    // $('#buscaEstados').on('click', function(){
    //     $.ajax({
    //             url: 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/50/municipios',
    //             dataType: 'json',
    //             success: function(resposta){
    //                 var count = resposta.length;
    //                 var script = "";
    //                 for (var i=0; i<count; i++){
    //                     script += "insert into municipios (descricao, id_estado, cadastradoPorUsuario, ativo) values ('" + resposta[i].nome + "', 24, 1, 1);\n";
    //                 }
    //                 $('#script').val(script);
    //                 // alert(script);
    //                 console.log('Resposta: ', resposta);
    //                 // console.log('Tamanho da resposta', count);
    //             },
    //             error: function(resposta){
    //                 alert("Erro");
    //             }
    //         });
    // });

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

