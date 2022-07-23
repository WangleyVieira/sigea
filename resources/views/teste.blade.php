@extends('layouts.main')

@section('title', 'SIGEA')

@section('content')

<h3 style="text-align: center">Matriz Curricular</h3>

<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">1º Período</th>
        <th scope="col">2º Período</th>
        <th scope="col">3º Período</th>
        <th scope="col">4º Período</th>
        <th scope="col">5º Período</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Fundamentos Matemáticos</td>
        <td>Inglês Instrumental</td>

      </tr>
      <tr>
        <td>Comunicação Linguística</td>
        <td>Metodologia da Pesquisa Científica</td>

      </tr>
      <tr>
        <td>Lógica Digital</td>
        <td>Banco de Dados I</td>
      </tr>
      <tr>
        <td>Organização de Empresas</td>
        <td>Análise e Projeto Orientado a Objetos</td>
        <td>Linguagem de Programação I</td>
      </tr>
      <tr>
        <td>Algoritmos</td>
        <td>Engenharia de Software I</td>
      </tr>
      <tr>
        <td>Construção de Páginas Web I</td>
        <td>Organização e Arquitetura de Computadores</td>

      </tr>

    </tbody>
  </table>

@endsection
