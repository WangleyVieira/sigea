@extends('layouts.main2')

@section('title', 'SIGEA')

@section('content')

    <div class="card mb-4">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" value="{{ $user->name }}" disabled="">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" value="{{ $user->email }}" disabled="">
            </div>
            <div class="mb-3">
                <label class="form-label">Perfil</label>
                <input type="text" class="form-control" value="{{ $user->perfil->descricao }}" disabled="">
            </div>
        </div>
    </div>

@yield('scripts')
@endsection





