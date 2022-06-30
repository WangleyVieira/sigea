<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIGEA</title>
    <link rel="shortcut icon" type="svg" href="{{ asset('image/layer-group-solid.svg') }}" style="color: #4a88eb">

    {{-- Styles --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.0/r-2.2.9/rr-1.2.8/datatables.min.css"/>
</head>
<body>
    <div class="main d-flex justify-content-center w-100">
        {{-- <nav class="navbar navbar-expand-md shadow-sm" style="background-color: #293042">
            <div class="container">
                <a class="sidebar-brand" href="{{ url('/') }}">
                    <span class="align-middle mr-3" style="font-size: .999rem;"></span>
                </a>
            </div>
        </nav> --}}

        <main class="authentication-content">
            <div class="container">
              <div class="mt-4">
                <div class="card rounded-0 overflow-hidden shadow-none border mb-5 mb-lg-0">
                  <div class="row g-0">
                    <div class="col-12 order-1 col-xl-8 d-flex align-items-center justify-content-center border-end">
                      <img src="assets/images/error/auth-img-7.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-12 col-xl-4 order-xl-2">
                      <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title">Entrar</h5>
                         <form class="form-body" action="{{route('login.autenticacao')}}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="row g-3">
                              <div class="col-12">
                                <label for="inputEmailAddress" class="form-label">Email</label>
                                <div class="ms-auto position-relative">
                                  <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                                  <input type="email" class="form-control radius-30 ps-5" id="inputEmailAddress" placeholder="Email">
                                </div>
                              </div>
                              <div class="col-12">
                                <label for="inputChoosePassword" class="form-label">Senha</label>
                                <div class="ms-auto position-relative">
                                  <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                  <input type="password" class="form-control radius-30 ps-5" id="inputChoosePassword" placeholder="Senha">
                                </div>
                              </div>
                              <div class="col-6 text-end">	<a href="authentication-forgot-password.html">Esqueci a senha?</a>
                              </div>
                              <div class="col-12">
                                <div class="d-grid">
                                  <button type="submit" class="btn btn-primary radius-30">Entrar</button>
                                </div>
                              </div>
                            </div>
                        </form>
                     </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           </main>
    </div>

{{-- Scripts --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ url('js/bootstrap.js') }}"></script>

</body>
</html>


