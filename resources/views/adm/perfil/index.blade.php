@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

@include('errors.alerts')
@include('errors.errors')

    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0">Informações de Perfil de Usuário</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('perfil_update', $user->id) }}" id="form" method="POST" class="form_prevent_multiple_submits">
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
                            <input class="form-control" type="password" name="password" placeholder="Informe uma senha">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Confirme a senha (mínimo 6 caracteres)</label>
                            <input class="form-control" type="password" name="confirmacao" placeholder="Confirme a senha">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Perfil</label>
                            <input type="text" class="form-control" value="{{ $user->perfil->descricao }}" disabled="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" class="btn btn-primary" name="Salvar" value="Salvar">
                            <a href="{{ route('adm.index_adm') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@yield('scripts')
@endsection





