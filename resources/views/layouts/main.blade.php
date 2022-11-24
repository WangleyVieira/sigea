<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>@yield('title')</title>
    <link rel="shortcut icon" type="svg" href="{{ asset('image/layer-group-solid.svg') }}" style="color: #4a88eb">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.0/r-2.2.9/rr-1.2.8/datatables.min.css"/>
    <link href="{{asset('select2-4.1.0/dist/css/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('select2-bootstrap/dist/select2-bootstrap.css')}}"/>
    <script src="{{ asset('js/jquery.js') }}"></script>

</head>
<style>
    .sidebar, .sidebar-nav, .sidebar-content{
        /* background-color: rgb(12, 71, 12); */
        background-color: rgb(9, 58, 9);
    }
    .navbar{
        background-color: rgb(148, 206, 148);
    }
    #footer{
        background-color: rgb(148, 206, 148);
    }
</style>
<div class="wrapper">
    <nav id="sidebar" class="sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="">
                {{-- <i class="fas fa-layer-group pt-2"></i> --}}
                <span class="align-middle mr-3" style="font-size: .999rem;">SIGEA</span>
            </a>
            <hr>

            <ul class="sidebar-nav">
                <li class="sidebar-header">
                    Páginas
                </li>
                @if (auth()->user()->id_perfil == 1)
                    <li class="sidebar-item {{ Route::current()->uri == 'adm/dashboard' ? 'active' : null }}">
                        <a href="{{ route('adm.index_adm') }}" class="sidebar-link">
                            <i class="fas fa-desktop"></i>
                            Dashboard
                        </a>
                    </li>
                @endif

                <li class="sidebar-item {{ Route::current()->uri == 'perfil' ? 'active' : null }}">
                    <a href="{{ route('perfil') }}" class="sidebar-link">
                        <i class="fas fa-user"></i>
                        Perfil do usuário
                    </a>
                </li>

                @if (auth()->user()->id_perfil == 1)
                    <li class="sidebar-item {{ Route::current()->uri == 'adm/usuario/usuarios-ativos' ? 'active' : null }}">
                        <a href="{{ route('adm.usuario.listagem_usuarios') }}" class="sidebar-link">
                            <i class="fas fa-fw fa-user-check"></i>
                            Usuários
                        </a>
                    </li>

                    <li class="sidebar-item {{ Route::current()->uri == 'adm/disciplinas' ? 'active' : null }}">
                        <a href="{{ route('adm.disciplinas.index') }}" class="sidebar-link">
                            <i class="fas fa-bookmark"></i>
                            Disciplinas
                        </a>
                    </li>

                    <li class="sidebar-item {{ Route::current()->uri == 'adm/topicos' ? 'active' : null }}">
                        <a href="{{ route('adm.topicos.index') }}" class="sidebar-link">
                            <i class="fas fa-tag"></i>
                            Tópicos
                        </a>
                    </li>

                    <li class="sidebar-item {{ Route::current()->uri == 'adm/questoes' ? 'active' : null }}">
                        <a href="{{ route('adm.questoes.index') }}" class="sidebar-link">
                            <i class="fas fa-book"></i>
                            Questões
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="#atividades" data-toggle="collapse" class="sidebar-link collapsed">
                            <i class="fas fa-folder"></i>
                            Atividades
                        </a>
                        <ul id="atividades" class="sidebar-dropdown list-unstyled {{
                            Route::current()->uri == 'adm/atividades' ||
                            Route::current()->uri == 'adm/atividades/cadastrar-atividade' ||
                            Route::current()->uri == 'adm/atividades' ? 'active' : 'collapse'
                            }}">
                           <li class="sidebar-item {{ Route::current()->uri == 'adm/atividades' ? 'active' : null }}">
                                <a class="sidebar-link" href="{{ route('adm.atividades.index') }}">
                                    Listar
                                </a>
                            </li>
                           <li class="sidebar-item {{ Route::current()->uri == 'adm/atividades/cadastrar-atividade' ? 'active' : null }}">
                                <a class="sidebar-link" href="{{ route('adm.atividades.create') }}">
                                    Cadastrar
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (auth()->user()->id_perfil == 2)
                    <li class="sidebar-item {{ Route::current()->uri == 'acesso-externo/questoes' ? 'active' : null }}">
                        <a href="{{ route('acesso_externo.questoes.index_externo') }}" class="sidebar-link">
                            <i class="fas fa-book"></i>
                            Questões
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="#atividades" data-toggle="collapse" class="sidebar-link collapsed">
                            <i class="fas fa-folder"></i>
                            Atividades
                        </a>
                        <ul id="atividades" class="sidebar-dropdown list-unstyled {{
                            Route::current()->uri == 'acesso-externo/atividades' ||
                            Route::current()->uri == 'acesso-externo/atividades/cadastrar-atividade' ||
                            Route::current()->uri == 'acesso-externo/atividades' ? 'active' : 'collapse'
                            }}">
                           <li class="sidebar-item {{ Route::current()->uri == 'acesso-externo/atividades' ? 'active' : null }}">
                                <a class="sidebar-link" href="{{ route('acesso_externo.atividades.index') }}">
                                    Listar
                                </a>
                            </li>
                           <li class="sidebar-item {{ Route::current()->uri == 'acesso-externo/atividades/cadastrar-atividade' ? 'active' : null }}">
                                <a class="sidebar-link" href="{{ route('acesso_externo.atividades.create') }}">
                                    Cadastrar
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
    </nav>

    <div class="main">
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            @if (Auth::check())
                <a class="sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>
            @endif

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align">

                    <a href="#">
                        <span class="glyphicon glyphicon-log-out"></span>
                    </a>
                    @if (Auth::guest())
                        <li>
                            <a class="btn btn-primary" style="color: white" href="{{ route('login') }}"
                                id="messagesDropdown" data-bs-toggle="dropdown">
                                <span>Login</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-toggle="dropdown">
                                <i class="fas fa-cog"></i>
                                <span class="text-dark"></span>
                            </a>
                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-toggle="dropdown">
                                <span class="avatar"><b>{{ auth()->user()->name }} - {{  auth()->user()->email }}</b></span>
                                <span class="text-dark"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Sair
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>


        <main class="content">
            @yield('content')
        </main>

        <footer class="footer" id="footer">
            <div class="container-fluid">
                <div class="row text-muted">
                    <div class="col-6 text-left">
                        <p class="mb-0">
                            &copy; <b>2022 - SIGEA - Sistema de Geração de Atividades</b>
                        </p>
                    </div>
                    <div class="col-6 text-right">
                        <p class="mb-0">
                            <a href="https://adminkit.io/" target="_blank" class="text-muted"><strong> &copy; AdminKit - Free & Premium Bootstrap 5 Admin Template</strong></a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>

    </div>
</div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('jquery-mask/dist/jquery.mask.min.js')}}"></script>
<script src="{{ url('js/fontawesome.js') }}"></script>
<script src="{{ url('js/bootstrap.js') }}"></script>
<script src="{{ url('js/functions.js') }}"></script>
<script src="{{ url('js/prevent_multiple_submits.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.0/r-2.2.9/rr-1.2.8/datatables.min.js"></script>
<script src="{{asset('select2-4.1.0/dist/js/select2.min.js')}}"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{asset('jquery-mask/src/jquery.mask.js')}}"></script>
@yield('scripts')
</html>
