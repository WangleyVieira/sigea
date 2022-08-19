@extends('layouts.main2')

@section('title', 'SIGEA')

@section('content')

<h1 class="mt-4">Disciplinas cadastradas</h1>
    <div class="card mb-2">
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Código</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($disciplinas as $d)
                        <tr>
                            <td> {{ $d->nome }}</td>
                            <td> {{ $d->codigo }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@yield('scripts')

@endsection
