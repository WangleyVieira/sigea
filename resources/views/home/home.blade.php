@extends('layout.main')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.4/select2-bootstrap.min.css" integrity="sha512-eNfdYTp1nlHTSXvQD4vfpGnJdEibiBbCmaXHQyizI93wUnbCZTlrs1bUhD7pVnFtKRChncH5lpodpXrLpEdPfQ==" crossorigin="anonymous" />
<style>
    .error{
          color:red
    }
</style>

<div class="col-12">
    <div class="card">
        @include('errors.alerts')
        @include('errors.errors')
        <div class="card-header">
            <h3>Usuário</h3>
        </div>
        <div class="card-body">
            <div class="form-group col-md-6">
                <label for="nome">Nome</label>
                <input type="text" name="nome" value="{{ $user->name }}" class="form-control" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="email">E-mail</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" readonly>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/jquery.js')}}"></script>

@endsection

