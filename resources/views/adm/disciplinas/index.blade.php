@extends('layouts.main')

@section('title', 'SIGEA')
<style>
    .error{
            color:red
    }
    #codigo_disciplina{
        text-transform: uppercase;
    }
</style>
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('errors.alerts')
{{-- @include('errors.errors') --}}

{{-- <div class="header">
    <h1 class="mt-4">Disciplinas cadastradas</h1>
</div>
<br> --}}
<div id="accordion">
    <div class="card">
        <div class="card-header" id="heading">
            <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapse">
                Cadastro de Disciplina
            </button>
            </h5>
        </div>
        <div id="collapse" class="collapse show" aria-labelledby="heading" data-parent="#accordion">
            <div class="card-body">
                <form action="{{ route('adm.disciplinas.store') }}" id="formDisciplina" method="POST" class="form_prevent_multiple_submits">
                    @csrf
                    @method('POST')
                    <div class="row">
                        {{-- <div class="form-group col-md-4">
                            <label for="disciplina">Nome disciplina</label>
                            <input type="text" name="disciplina" id="disciplina" class="form-control">
                        </div> --}}
                        <div class="form-group col-md-4">
                            <label for="disciplina">Nome disciplina</label>
                            <input type="text" name="nome" id="disciplina" class="form-control @error('nome') is-invalid @enderror">
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="codigo">Código</label>
                            <input type="text" name="codigo" class="form-control @error('codigo') is-invalid @enderror" id="codigo_disciplina">
                            @error('codigo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="id_periodo">Selecione o período</label>
                            <select class="form-control @error('codigo') is-invalid @enderror" name="id_periodo">
                                <option value="" selected disabled> -- selecione -- </option>
                                @foreach ($periodos as $p)
                                    <option value="{{ $p->id }}"> {{ $p->descricao }} </option>
                                @endforeach
                            </select>
                            @error('id_periodo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </div>

               </form>
            </div>
        </div>
    </div>
</div>


<div id="accordion2">
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Listagem de Disciplina
                </button>
            </h5>
        </div>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion2">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable-responsive">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Descricao</th>
                                <th scope="col">Período</th>
                                <th scope="col">Código Disciplina</th>
                                <th scope="col">Tópicos</th>
                                <th scope="col">Alterar</th>
                                <th scope="col">Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($disciplinas as $d)
                                <tr>
                                    <td> {{ $d->nome }}</td>
                                    <td> {{ $d->periodo->descricao}}</td>
                                    <td> {{ $d->codigo }}</td>
                                    <td>
                                        <a class="btn btn-outline-secondary" data-toggle="modal" data-target="#listTopico{{ $d->id }}"><i class="fas fa-list"></i></a>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-outline-warning" data-toggle="modal" data-target="#updateModal{{ $d->id }}"><i class="fas fa-pen"></i></a>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-danger" data-toggle="modal" data-target="#dangerModal{{ $d->id }}"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>

                                {{-- modal de excluir --}}
                                <div class="modal fade" id="dangerModal{{ $d->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <form action="{{ route('adm.disciplinas.destroy', $d->id) }}" method="POST" id="delete_form">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-header" style="background-color: rgb(218, 105, 105)">
                                                    <h5 class="modal-title">Tem certeza que deseja excluir disciplina <b>{{ $d->nome }}</b>, <b>tópicos </b> e <b>questões</b> vinculados a estes ?</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="motivo" class="form-label">Motivo</label>
                                                            <input type="text" class="form-control" name="motivo" id="" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                {{-- modal de alterar --}}
                                <div class="modal fade" id="updateModal{{ $d->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('adm.disciplinas.update', $d->id) }}" method="POST" id="alterar_form">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-header" style="background-color: rgb(241, 187, 125)">
                                                    <h5 class="modal-title">Alterar disciplina</b>?</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label for="disciplina">Disciplina</label>
                                                            <input type="text" name="disciplina" id="disciplina" class="form-control" value="{{ $d->nome}}" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="codigo">Código</label>
                                                            <input type="text" name="codigo" id="codigo" class="form-control" value="{{ $d->codigo}}" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="id_periodo">Selecione o período</label>
                                                            <select class="form-control mb-3" name="id_periodo">
                                                                <option value="" selected disabled> -- selecione -- </option>
                                                                @foreach ($periodos as $p)
                                                                    <option value="{{ $p->id }}" {{ $p->id == $d->id_periodo ? 'selected' : '' }}>
                                                                    {{ $p->descricao}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                                    <button type="submit" class="btn btn-warning">Alterar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- cadastrar tópico --}}
                                {{-- <div class="modal fade" id="createTopico{{ $d->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('adm.topicos.store', $d->id) }}" method="POST" id="cad_topico_form">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-header" style="background-color: rgb(113, 166, 235)">
                                                    <h5 class="modal-title">Vincular tópica a discipina <b> {{ $d->nome}} </b></h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label for="descricao">Descricao*</label>
                                                            <input type="text" name="descricao" id="descricao" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                                    <button type="submit" class="btn btn-success">Cadastrar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- listagem de tópicos --}}
                                <div class="modal fade" id="listTopico{{ $d->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: rgb(151, 160, 170)">
                                                <h5 class="modal-title">Listagem de Tópicos da Disciplina <b> {{ $d->nome}} </b></h5>
                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    @if (Count($d->topicos) != 0)
                                                    <ul>
                                                        @foreach ($d->topicos as $top)
                                                            <li style="text-align: left">
                                                                {{ $top->descricao }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    @else
                                                        <ul style="text-align: center">
                                                            <li>Sem tópico cadastrado</li>
                                                        </ul>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('../js/jquery.validate.js')}}"></script>

<script>

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

        $('#datatable-responsive').dataTable({
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
