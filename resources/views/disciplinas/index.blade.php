@extends('layouts.main2')

@section('title', 'SIGEA')

@section('content')

<div class="header">
    <h1 class="mt-4">Disciplinas cadastradas</h1>
</div>

<div class="card">
    <div class="card-body">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Período</th>
                    <th scope="col">Código</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($disciplinas as $d)
                    <tr>
                        <td> {{ $d->nome }}</td>
                        <td> {{ $d->periodo->descricao}}</td>
                        <td> {{ $d->codigo }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
