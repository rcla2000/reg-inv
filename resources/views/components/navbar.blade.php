<nav class="navbar navbar-expand-lg fixed-top bg-conacyt">
    <div class="container">
        <a class="navbar-brand logo-institucion me-4" href="#">
            <img src="{{ asset('assets/img/Logo_Gobierno.svg') }}" alt="Logo Gobierno de El Salvador"
                title="Logo Gobierno de El Salvador">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page"
                        href="{{ route('investigadores.inicio') }}">
                        <i class="fa-solid fa-pen-to-square me-1"></i>
                        Revisión
                    </a>
                </li>
                @if(Auth::user()->user_type == 1)
                    <li class="nav-item">
                        <a class="nav-link active text-white"
                            href="{{ route('usuarios.listar') }}">
                            <i class="fa-solid fa-user me-1"></i>
                            Usuarios
                        </a>
                    </li>
                @endif
            </ul>
            <span class="navbar-text">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->username }}
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <button class="dropdown-item" type="submit" form="frm-logout">
                                Cerrar sesión
                            </button>
                            <form method="POST" action="{{ route('logout') }}" class="d-none" id="frm-logout">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </span>
        </div>
    </div>
</nav>
