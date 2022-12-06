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

@include('errors.alerts')
@include('errors.errors')

    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0">Alteração de dados do usuário</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('adm.usuario.update', $user->id) }}" id="form-user" method="POST" class="form_prevent_multiple_submits">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" name="nome">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" value="{{ $user->email }}" name="email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="form-label">Senha (mínimo 6 caracteres)</label>
                            <input class="form-control" type="password" name="password" placeholder="Digite uma senha para alterar">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Confirme a senha (mínimo 6 caracteres)</label>
                            <input class="form-control" type="password" name="confirmacao" placeholder="Confirme novamente a senha">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Perfil</label>
                            <select name="id_perfil" id="id_perfil" class="form-control">
                                @foreach ($perfils as $perfil)
                                    <option value="{{ $perfil->id }}" {{ $perfil->id == $user->id_perfil ? 'selected' : '' }}>
                                        {{ $perfil->descricao }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" value="{{ $user->perfil->descricao }}" disabled=""> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" class="btn btn-primary" name="Salvar" value="Salvar">
                            <a href="{{ route('adm.usuario.listagem_usuarios') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="{{asset('../js/jquery.validate.js')}}"></script>
@yield('scripts')

<script>

    $("#form-user").validate({
        rules: {
            nome:{
                required:true,
                maxlength:255,
            },
            email:{
                required:true,
                maxlength:255,
            },
            id_perfil:{
                required:true,
                maxlength:255,
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
            id_perfil:{
                required:"Campo obrigatório",
                maxlength:"Máximo de 255 caracteres"
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

    });
</script>
@endsection





