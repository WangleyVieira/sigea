@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

    <div>
        <h3>Informações de Perfil de Usuário</h3>
    </div>
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group col-md-6">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" disabled="">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" value="{{ $user->email }}" disabled="">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label">Perfil</label>
                    <input type="text" class="form-control" value="{{ $user->perfil->descricao }}" disabled="">
                </div>
            </div>
        </div>
    </div>

@yield('scripts')
@endsection





