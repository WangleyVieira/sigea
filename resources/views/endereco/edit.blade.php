@extends('layout.main')

@section('content')

@include('errors.alerts')
@include('errors.errors')

<div class="col-12">
    <header class="container">
        <h2 class="text-center">
            <div>
                <span><i class="fas fa-address-book"></i></span>
            </div>
            <strong>Alteração de dados</strong>
        </h2>
    </header>

    <form action="{{ route('endereco.update', $end->id) }}" id="form" method="POST">
        @csrf
        @method('POST')
        <div class="card">
            <div class="card-body">

            <h5>Dados Pessoais</h5>
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="form-label">Nome</label>
                    <input class="form-control form-control-lg" type="text" name="nome" id="nome" value="{{ $end->nome }}" placeholder="Informe seu nome" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label">CPF</label>
                    <input class="cpf form-control form-control-lg" type="text" name="cpf" id="cpf" value="{{ $end->cpf }}" placeholder="Informe seu CPF" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label">Email</label>
                    <input class="form-control form-control-lg" type="email" name="email" value="{{ $end->email }}" placeholder="Informe um email válido" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="telefone_contato1">Telefone (Celular)</label>
                    <input type="text" name="telefone_contato1" id="telefone_contato1" value="{{ $end->telefone }}"class="form-control form-control-lg">
                </div>
            </div>
            <br>
            <hr>
            <br>
            <h5>Dados de endereço</h5>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="cep">CEP</label>
                            <input type="text" name="cep" id="cep" class="form-control form-control-lg" value="{{ $end->cep }}" placeholder="Informe o CEP">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="endereco">Endereço (Rua/Avenida)</label>
                            <input type="text" name="endereco" id="endereco" class="form-control form-control-lg" value="{{ $end->endereco }}" placeholder="Informe o endereço">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" id="cidade" class="form-control form-control-lg" value="{{ $end->cidade }}" placeholder="Informe a cidade">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="uf">UF</label>
                            <input type="text" name="uf" id="uf" class="form-control form-control-lg" value="{{ $end->uf }}" placeholder="Informe a UF">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="numero">Número</label>
                            <input type="text" name="numero" id="numero" class="form-control form-control-lg" value="{{ $end->numero }}" placeholder="Informe o número">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="bairro">Bairro</label>
                            <input type="text" name="bairro" id="bairro" class="form-control form-control-lg" value="{{ $end->bairro }}" placeholder="Informe o bairro">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="complemento">Complemento</label>
                            <input type="text" name="complemento" id="complemento" class="form-control form-control-lg" value="{{ $end->complemento }}" placeholder="Informe o complemento">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="ponto_referencia">Ponto de Referência</label>
                            <input type="text" name="ponto_referencia" class="form-control form-control-lg" value="{{ $end->ponto_referencia }}" placeholder="Informe o ponto de referência">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="lat">Latitude (graus decimais)</label>
                            <input type="text" name="lat" id="lat" class="form-control form-control-lg" value="{{ $end->lat }}">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="long">Longitude (graus decimais)</label>
                            <input type="text" name="long" id="long" class="form-control form-control-lg" value="{{ $end->long }}">
                        </div>
                    </div>
                </div>

                <div id="map"></div>

            </div>
        </div>
        <div class="col-md-12">
            <a onclick="apresentar()" class="btn btn-secondary m-1">Apresentar no mapa</a>
            <button type="submit" class="btn btn-warning m-1">Alterar</button>
        </div>
        <br>
    </form>
</div>

<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js" integrity="sha512-A7vV8IFfih/D732iSSKi20u/ooOfj/AGehOKq0f4vLT1Zr2Y+RX7C+w8A1gaSasGtRUZpF/NZgzSAu4/Gc41Lg==" crossorigin=""></script>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{asset('jquery-mask/src/jquery.mask.js')}}"></script>

<script>

    $('.cpf').mask('000.000.000-00');
    $('#telefone_contato1').mask('(00) 0 0000-0000');
    //script relacionado ao CEP
    $('#cep').mask('00.000-000');

    $('#cep').on('change', function(){
        var cep = $(this).val().replace(/[.-]/g,"");
        // console.log('CEP: ', cep);
        // console.log('Quantidade de caracteres: ', cep.length);
        if (cep.length != 8){
            $("#endereco").val('');
            $("#complemento").val('');
            $("#bairro").val('');
            $("#cidade").val('');
            $("#uf").val('');
            alert('CEP INVÁLIDO!');
        }
        else{
            $.ajax({
                //O campo URL diz o caminho de onde virá os dados
                //É importante concatenar o valor digitado no CEP

                // url: 'https://viacep.com.br/ws/'+cep+'/json/',

                url: 'https://brasilapi.com.br/api/cep/v2/'+cep,
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
                    $("#endereco").val(resposta.street);
                    // $("#complemento").val(resposta.complemento);
                    $("#bairro").val(resposta.neighborhood);
                    $("#cidade").val(resposta.city);
                    $("#uf").val(resposta.state);
                    $("#lat").val(resposta.location.coordinates.latitude);
                    $("#long").val(resposta.location.coordinates.longitude);
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
                    $("#cidade").val('');
                    $("#uf").val('');
                    $("#lat").val('');
                    $("#long").val('');
                    //Vamos incluir para que o Número seja focado automaticamente
                    //melhorando a experiência do usuário
                    $("#cep").focus();
                },
            });
        }
    });


    var map = L.map('map').setView([-20.46818922, -54.61853027], 5);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);


    function apresentar(){

        lati = $('#lat').val();
        long = $('#long').val();

        if (lati == '' || long == '') {
            alert('CEP não localizado, informar latitude e longitude para localizar.')
            return;
        }

        var marker = L.marker([lati, long]).addTo(map)
            .bindPopup('Geolocalização aproximada do CEP')
            .openPopup();
    }

</script>
@endsection
