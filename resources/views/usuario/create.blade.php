@extends('layout.main')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="http://maps.google.com/maps/api/js?key=AIzaSyAUgxBPrGkKz6xNwW6Z1rJh26AqR8ct37A"></script>
<script src="{{ asset('js/gmaps.js') }}"></script>

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
        <strong>Cadastro de clientes e as coordenadas</strong>
    </h2>
</header>

<div class="container" style="padding: 3rem; background-color:white">

    <form action="{{ route('usuario.store') }}" id="form" method="POST">
        @csrf
        @method('POST')

        <div id="accordion2">
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            Dados do cliente
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion2">
                <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Dados Pessoais</h5>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="form-label">Nome</label>
                                        <input class="form-control form-control-lg" type="text" name="name" id="name" placeholder="Informe seu nome">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="form-label">CPF</label>
                                        <input class="cpf form-control form-control-lg" type="text" name="cpf" id="cpf" placeholder="Informe seu CPF">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="form-label">Email</label>
                                        <input class="form-control form-control-lg" type="email" name="email" placeholder="Informe um email válido">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="uf">UF</label>
                                        <select name="uf" id="uf" class="form-control form-control-lg select2" required>
                                                <option value="" selected disabled>Selecione o estado</option>
                                            @foreach ($estados as $estado)
                                                <option value="{{ $estado->id }}">{{ $estado->sigla }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="id_municipio">Município</label>
                                            <select name="id_municipio" id="id_municipio" class="form-control form-control-lg select2" required>
                                                <option value="" selected disabled>Selecione o município</option>
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
                                        <input type="text" name="cep" id="cep" class="form-control form-control-lg" placeholder="Informe o CEP" onchange="geocode(e)">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="endereco">Endereço (Rua/Avenida)</label>
                                        <input type="text" name="endereco" id="endereco" class="form-control form-control-lg" placeholder="Informe o endereço">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="numero">Número</label>
                                        <input type="text" name="numero" id="numero" class="form-control form-control-lg" placeholder="Informe o número">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="bairro">Bairro</label>
                                        <input type="text" name="bairro" id="bairro" class="form-control form-control-lg" placeholder="Informe o bairro">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="complemento">Complemento</label>
                                        <input type="text" name="complemento" id="complemento" class="form-control form-control-lg" placeholder="Informe o complemento">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="ponto_referencia">Ponto de Referência</label>
                                        <input type="text" name="ponto_referencia" class="form-control form-control-lg" placeholder="Informe o ponto de referência">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="accordion3">
            <div class="card">
                <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Coordenadas do cliente
                    </button>
                </h5>
                </div>
                <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion3">
                    <div class="card-body">
                        <legend>Pontos únicos</legend>
                        <div class="row mb-2" id="pontos1">
                            <div class="col-md-4" id="ponto1" style="border: 0.5px solid #CBCBCB">
                                <div class="col-12"><strong style="color: black">Ponto 1</strong></div>
                                <label class="form-label" for="latitudePonto[]">Latitude (graus decimais)</label>
                                <input type="text" name="latitudePonto[]" id="latPonto1" class="form-control mb-2" required>
                                <label class="form-label" for="longitudePonto[]">Longitude (graus decimais)</label>
                                <input type="text" name="longitudePonto[]" id="longPonto1" class="form-control mb-2" required>
                            </div>
                            {{-- <div class="col-md-4" id="ponto2" style="border: 0.5px solid #CBCBCB">
                                <div class="col-12"><strong style="color: black">Ponto 2</strong></div>
                                <label class="form-label" for="latitudePonto[]">Latitude (graus decimais)</label>
                                <input type="text" name="latitudePonto[]" id="latPonto2" class="form-control mb-2" required>
                                <label class="form-label" for="longitudePonto[]">Longitude (graus decimais)</label>
                                <input type="text" name="longitudePonto[]" id="longPonto2" class="form-control mb-2" required>
                            </div>
                            <div class="col-md-4" id="ponto3" style="border: 0.5px solid #CBCBCB">
                                <div class="col-12"><strong style="color: black">Ponto 3</strong></div>
                                <label class="form-label" for="latitudePonto[]">Latitude (graus decimais)</label>
                                <input type="text" name="latitudPontoe[]" id="latPonto3" class="form-control mb-2" required>
                                <label class="form-label" for="longitudePonto[]">Longitude (graus decimais)</label>
                                <input type="text" name="longitudePonto[]" id="longPonto3" class="form-control mb-2" required>
                            </div> --}}
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="descPonto">Descrição</label>
                                <input type="text" name="descPonto" id="descPonto" class="form-control" value="{{ old('descPonto') }}">
                            </div>

                            <div class="col-md-12">
                                <a onclick="adicionar1()" class="btn btn-success btn-pill float-left m-1">Adicionar ponto</a>
                                <a onclick="remover1()" class="btn btn-danger btn-pill float-left m-1">Remover ponto</a>
                                <a onclick="apresentar1()" class="btn btn-secondary float-right m-1">Apresentar no mapa</a>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3" style="height: 300px;">
                            <div id="map1" style="height: 100%;"></div>
                        </div>
                        <hr class="mt-5">
                        <legend>Figuras</legend>
                        <div class="row mb-2" id="pontos2">
                            <div class="col-md-4" id="pontoFigura1" style="border: 0.5px solid #CBCBCB">
                                <div class="col-12"><strong style="color: black">Ponto 1</strong></div>
                                <label class="form-label" for="latitudeFigura[]">Latitude (graus decimais)</label>
                                <input type="text" name="latitudeFigura[]" id="latFigura1" class="form-control mb-2" required>
                                <label class="form-label" for="longitudeFigura[]">Longitude (graus decimais)</label>
                                <input type="text" name="longitudeFigura[]" id="longFigura1" class="form-control mb-2" required>
                            </div>
                            <div class="col-md-4" id="pontoFigura2" style="border: 0.5px solid #CBCBCB">
                                <div class="col-12"><strong style="color: black">Ponto 2</strong></div>
                                <label class="form-label" for="latitudeFigura[]">Latitude (graus decimais)</label>
                                <input type="text" name="latitudeFigura[]" id="latFigura2" class="form-control mb-2" required>
                                <label class="form-label" for="longitudeFigura[]">Longitude (graus decimais)</label>
                                <input type="text" name="longitudeFigura[]" id="longFigura2" class="form-control mb-2" required>
                            </div>
                            <div class="col-md-4" id="pontoFigura3" style="border: 0.5px solid #CBCBCB">
                                <div class="col-12"><strong style="color: black">Ponto 3</strong></div>
                                <label class="form-label" for="latitudeFigura[]">Latitude (graus decimais)</label>
                                <input type="text" name="latitudeFigura[]" id="latFigura3" class="form-control mb-2" required>
                                <label class="form-label" for="longitudeFigura[]">Longitude (graus decimais)</label>
                                <input type="text" name="longitudeFigura[]" id="longFigura3" class="form-control mb-2" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="descFigura">Descrição</label>
                                <input type="text" name="descFigura" id="descFigura" class="form-control" value="{{ old('descFigura') }}">
                            </div>

                            <div class="col-md-12">
                                <a onclick="adicionar2()" class="btn btn-success btn-pill float-left m-1">Adicionar ponto</a>
                                <a onclick="remover2()" class="btn btn-danger btn-pill float-left m-1">Remover ponto</a>
                                <a onclick="apresentar2()" class="btn btn-secondary float-right m-1">Apresentar no mapa</a>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3" style="height: 300px;">
                            <div id="map2" style="height: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container-fluid text-center">
            <button type="submit" style="width: 130px;" class="btn btn-primary p-2">Cadastrar</button>
        </div>
    </form>

</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{asset('jquery-mask/src/jquery.mask.js')}}"></script>

<script>
    $('#cep').mask('00.000-000');
    $('.cpf').mask('000.000.000-00');

    //Escutando o focusout da div dados contato
    $('#numero').blur(function() {
        campoNumero = document.getElementById('numero').value;
        campoCep = document.getElementById('cep').value;

        if (campoCep != null && campoCep != '' && campoNumero != null && campoNumero != '') {
            geocode();
        }

    });

    $('#cep').blur(function() {

        campoCep = document.getElementById('cep').value;
        campoNumero = document.getElementById('numero').value;

        if (campoCep != null && campoCep != '' && campoNumero != null && campoNumero != '') {
            geocode();
        }

    });

    //Função para buscar as coordenadas
    function geocode() {

        //e.preventDefault()

        var cep = document.getElementById('cep').value;
        var rua = document.getElementById('endereco').value;
        var numero = document.getElementById('numero').value;

        var location = rua + ', ' + numero + ', ' + 'CEP ' + cep;
        console.log(location);
        axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
            params: {
                address: location,
                key: 'AIzaSyDkLzj3TDpGC9hCoG5B73txwqSHDgCvgHo'
            }
        })
        .then(function(response) {

            var lat = response.data.results[0].geometry.location.lat;
            var lng = response.data.results[0].geometry.location.lng;

            document.getElementById('latPonto1').value = lat;
            document.getElementById('longPonto1').value = lng;

            console.log(lat, lng);
        })
        .catch(function(error) {
            document.getElementById('latPonto1').value = '';
            document.getElementById('longPonto1').value = '';
            return error;
        })
    }

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
        // // cep.replace(['/[.-]/g', '');
        // // console.log(cep);
        // // '/[^0-9]/'
        // // Início do Comando AJAX

    });

    map1 = new GMaps({
        div: '#map1',
        zoom: 5,
        lat: -20.46818922,
        lng: -54.61853027
    });

    count1 = 2;

    function adicionar1() {
        linha1 = '<div class="col-md-4" id="ponto'+count1+'" style="border: 0.5px solid #CBCBCB">';
        linha2 = '<div class="col-12"><strong style="color: black">Ponto '+count1+'</strong></div>';
        linha3 = '<label class="form-label" for="latitudePonto[]">Latitude (graus decimais)</label>';
        linha4 = '<input type="text" name="latitudePonto[]" id="latPonto'+count1+'" class="form-control mb-2" required>';
        linha5 = '<label class="form-label" for="longitudePonto[]">Longitude (graus decimais)</label>';
        linha6 = '<input type="text" name="longitudePonto[]" id="longPonto'+count1+'" class="form-control mb-2" required>';
        linha7 = '</div>';

        div = linha1+linha2+linha3+linha4+linha5+linha6+linha7;

        $('#pontos1').append(div);

        count1++;
    }

    function remover1() {

        if (count1 == 2) {
            return window.alert('Deve haver no mínimo 1 ponto!');
        }

        count1--;

        $('#ponto'+count1).remove();
    }

    function apresentar1(){
        map1.removeMarkers();

        if ($('#latPonto1').val() != '' && $('#longPonto1').val() != '') {
            map1.setCenter($('#latPonto1').val(), $('#longPonto1').val());
        }

        map1.setZoom(16);

        for (let i = 1; i < count1; i++) {

            if ($('#latPonto'+i).val() == '' || $('#longPonto'+i).val() == '') {
                return;
            }

            map1.addMarker({
                lat: $('#latPonto'+i).val(),
                lng: $('#longPonto'+i).val(),
                infoWindow: {
                    content: 'Ponto '+i
                }
            });

        }
    }

    map2 = new GMaps({
        div: '#map2',
        zoom: 5,
        lat: -20.46818922,
        lng: -54.61853027
    });

    count2 = 4;

    function adicionar2() {
        linha1 = '<div class="col-md-4" id="pontoFigura'+count2+'" style="border: 0.5px solid #CBCBCB">';
        linha2 = '<div class="col-12"><strong style="color: black">Ponto '+count2+'</strong></div>';
        linha3 = '<label class="form-label" for="latitudeFigura[]">Latitude (graus decimais)</label>';
        linha4 = '<input type="text" name="latitudeFigura[]" id="latFigura'+count2+'" class="form-control mb-2" required>';
        linha5 = '<label class="form-label" for="longitudeFigura[]">Longitude (graus decimais)</label>';
        linha6 = '<input type="text" name="longitudeFigura[]" id="longFigura'+count2+'" class="form-control mb-2" required>';
        linha7 = '</div>';

        div = linha1+linha2+linha3+linha4+linha5+linha6+linha7;

        $('#pontos2').append(div);

        count2++;
    }

    function remover2() {

        if (count2 == 4) {
            return window.alert('A figura deve ter no mínimo 3 pontos!');
        }

        count2--;

        $('#pontoFigura'+count2).remove();
    }

    function apresentar2(){
        map2.removePolygons();
        map2.removeMarkers();

        lati1 = $('#latFigura1').val();
        long1 = $('#longFigura1').val();
        lati2 = $('#latFigura2').val();
        long2 = $('#longFigura2').val();
        lati3 = $('#latFigura3').val();
        long3 = $('#longFigura3').val();

        if (lati1 == '' || long1 == '' || lati2 == '' || long2 == '' || lati3 == '' || long3 == '') {
            return window.alert('A figura deve ter no mínimo 3 pontos!');
        }

        map2.addMarker({
            lat: lati1,
            lng: long1,
            infoWindow: {
                content: 'Ponto 1'
            }
        });
        map2.addMarker({
            lat: lati2,
            lng: long2,
            infoWindow: {
                content: 'Ponto 2'
            }
        });
        map2.addMarker({
            lat: lati3,
            lng: long3,
            infoWindow: {
                content: 'Ponto 3'
            }
        });

        path = [[lati1, long1], [lati2, long2], [lati3, long3]];

        for (let i = 4; i < count2; i++) {

            lati = $('#latFigura'+i).val();
            long = $('#longFigura'+i).val();

            if (lati != '' && long != '') {
                path.push([lati, long]);

                map2.addMarker({
                    lat: lati,
                    lng: long,
                    infoWindow: {
                        content: 'Ponto '+i
                    }
                });
            }else{
                return window.alert('Complete corretamente a latitude e longitude dos pontos!');
            }
        }

        map2.drawPolygon({
            paths: path,
            strokeColor: '#BBD8E9',
            strokeOpacity: 1,
            strokeWeight: 3,
            fillColor: '#BBD8E9',
            fillOpacity: 0.6
        });

        map2.setCenter(lati1,long1);
        map2.setZoom(14);
    }

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
