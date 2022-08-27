@if (session('success'))
<div class="alert alert-success alert-dismissible" role="alert">
    <div class="alert-message">
        <strong>Sucesso!</strong> {{ session('success') }}
    </div>
</div>
@endif

@if (session('erro'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <div class="alert-message">
        <strong>Erro!</strong> {{ session('erro') }}
    </div>
</div>
@endif

@if (session('danger'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <div class="alert-message">
            <strong>Atenção!</strong> {{ session('danger') }}
        </div>
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        <div class="alert-message">
            <strong>Atenção!</strong> {{ session('warning') }}
        </div>
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info alert-dismissible" role="alert">
        <div class="alert-message">
            {{ session('info') }}
        </div>
    </div>
@endif
