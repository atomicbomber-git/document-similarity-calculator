<nav class="navbar navbar-dark bg-dark navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#"> Penghitung Similaritas Dokumen </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link {{ Route::is('process.*') ? 'active' : '' }}" href="{{ route('process.control_panel') }}"> Pasangan Dokumen </a>
            <a class="nav-item nav-link {{ Route::is('thesis.*') ? 'active' : '' }}" href="{{ route('thesis.index') }}"> Skripsi </a>
            </div>

            <ul class="navbar-nav ml-auto">
                <form action="{{ route("logout") }}"
                      method="POST"
                >
                    @csrf
                    @method("POST")
                    <button class="btn btn-danger btn-sm">
                        Logout <i class="fa fa-sign-out"></i>
                    </button>
                </form>
            </ul>
        </div>
    </div>
</nav>