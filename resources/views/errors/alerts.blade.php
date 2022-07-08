@if (session('success'))
    <div class="alert alert-success mt-2" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (session('danger'))
    <div class="alert alert-danger mt-2" role="alert">
        {{ session('danger') }}
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning mt-2" role="alert">
        {{ session('warning') }}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info mt-2" role="alert">
        {{ session('info') }}
    </div>
@endif
