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

{{-- @include('errors.alerts')
@include('errors.errors') --}}

    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0">Cadastrar usuário</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('adm.usuario.salvar_usuario') }}" id="form-user" method="POST" class="form_prevent_multiple_submits">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome') }}">
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="form-label">Senha (mínimo 6 caracteres)</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Digite uma senha">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Confirme a senha (mínimo 6 caracteres)</label>
                            <input class="form-control @error('confirmacao') is-invalid @enderror" type="password" name="confirmacao" placeholder="Confirme novamente a senha">
                            @error('confirmacao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Perfil</label>
                            <select name="id_perfil" id="id_perfil" class="form-control @error('id_perfil') is-invalid @enderror">
                                <option value="">-- Selecione -</option>
                                <option value="1" {{ old('id_perfil') == '1' ? 'selected' : '' }}>Administrador</option>
                                <option value="2" {{ old('id_perfil') == '2' ? 'selected' : '' }}>Usuário externo</option>
                            </select>
                            @error('id_perfil')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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

    // $("#form-user").validate({
    //     rules: {
    //         nome:{
    //             required:true,
    //             maxlength:255,
    //         },
    //         email:{
    //             required:true,
    //             maxlength:255,
    //         },
    //         password:{
    //             required:true,
    //             maxlength:255,
    //         },
    //         confirmacao:{
    //             required:true,
    //             maxlength:255,
    //         },
    //         id_perfil:{
    //             required:true,
    //             maxlength:255,
    //         },
    //     },

    //     messages: {
    //         nome:{
    //             required:"Campo obrigatório",
    //             maxlength:"Máximo de 255 caracteres"
    //         },
    //         email:{
    //             required:"Campo obrigatório",
    //             maxlength:"Máximo de 255 caracteres"
    //         },
    //         password:{
    //             required:"Campo obrigatório",
    //             maxlength:"Máximo de 255 caracteres"
    //         },
    //         confirmacao:{
    //             required:"Campo obrigatório",
    //             maxlength:"Máximo de 255 caracteres"
    //         },
    //         id_perfil:{
    //             required:"Campo obrigatório",
    //             maxlength:"Máximo de 255 caracteres"
    //         },
    //     }
    // });

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





