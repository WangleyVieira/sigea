@extends('layout.main')

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
        <strong>Listagem de clientes</strong>
    </h2>
</header>

<div class="container" style="padding: 3rem; background-color:white">

    <div class="card-body">

        @if (Count($usuarios) == 0)
            <div>
                <h1 class="alert-info px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center"> Não há cadastros no sistema.</h1>
            </div>
        @else
            <div class="table-responsive">
                <table id="datatables-reponsive" class="table table-bordered" style="width: 100%;">
                {{-- <table class="table table-bordered text-center"> --}}
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Email</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">Empresas</th>
                            <th scope="col">Cadastrado em</th>
                            <th scope="col">Mapa</th>
                            <th scope="col">Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->name != null ? $usuario->name : 'não informado' }}</td>
                                <td class="cpf">{{ $usuario->cpf != null ? $usuario->cpf : 'não informado' }}</td>
                                <td>{{ $usuario->email != null ? $usuario->email : 'não informado' }}</td>
                                <td>
                                    CEP: {{ $usuario->cep != null ? $usuario->cep : 'não informado' }} <br>
                                    Rua/Avenida: {{ $usuario->endereco != null ? $usuario->endereco : 'não informado' }} <br>
                                    Bairro: {{ $usuario->bairro != null ? $usuario->bairro : 'não informado' }} <br>
                                    Número: {{ $usuario->numero != null ? $usuario->numero : 'não informado' }} <br>
                                    Município/Estado: {{ $usuario->id_municipio != null ? $usuario->municipio->descricao : 'municipio não informado' }} /
                                    {{ $usuario->id_estado != null ? $usuario->estado->sigla : 'estado não informado' }}
                                </td>
                                <td>
                                    @if (Count($usuario->empresas) != 0)
                                        <ol style="text-align: left">
                                            @foreach ($usuario->empresas as $empresa)
                                                <li>{{ $empresa->nome }} - CNPJ: {{ $empresa->cnpj }}</li>
                                            @endforeach
                                        </ol>
                                    @else
                                        Sem empresa cadastrada
                                    @endif
                                </td>
                                <td>{{ $usuario->created_at != null ? $usuario->created_at->format('d/m/Y H:i:s') : 'sem registro' }}</td>
                                {{-- <td>
                                    <a href="{{ route('usuario.edit', $usuario->id) }}"
                                    class="btn btn-warning">Alterar</a>
                                </td> --}}
                                <td>
                                    <a href="{{ route('usuario.mapa', $usuario->id) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                </td>
                                <td>
                                    <a href="{{ route('usuario.edit', $usuario->id) }}" class="btn btn-warning"><i class="align-middle me-2 fas fa-fw fa-pen"></i></a>
                                </td>
                                {{-- <td>
                                    <a href="{{ route('atividades_em_grupo.atividade.pdf', $atividade->id) }}"
                                    class="btn btn-info">PDF</a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>

<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{asset('jquery-mask/src/jquery.mask.js')}}"></script>

<script>

    $('.cpf').mask('000.000.000-00');

    $(document).ready(function() {

        $('#datatables-reponsive').dataTable({
            "oLanguage": {
                "sLengthMenu": "Mostrar _MENU_ registros por página",
                "sZeroRecords": "Nenhum registro encontrado",
                "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
                "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
                "sInfoFiltered": "(filtrado de _MAX_ registros)",
                "sSearch": "Pesquisar: ",
                "oPaginate": {
                    "sFirst": "Início",
                    "sPrevious": "Anterior",
                    "sNext": "Próximo",
                    "sLast": "Último"
                }
            },
        });
    });

</script>

@endsection
