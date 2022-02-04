<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Imobiliária</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item dropdown me-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Opções
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('realty.create') }}">Novo imóvel</a></li>
                        <li><a class="dropdown-item" href="{{ route('category.create') }}">Nova Categoria</a></li>
                        <li><a class="dropdown-item" href="{{ route('usage.create') }}">Nova Finalidade</a></li>
                    </ul>
                </li>
            </ul>
            <div class="d-flex">
                <div class="d-flex">
                    <div class="align-self-center">
                        <li class="nav-item list-unstyled align-self-center">
                            <a href="{{ route('category.dashboard') }}">
                                <i class="fas fa-users-cog align-self-center" title="Painel Administrativo"></i>
                            </a>
                        </li>
                    </div>
                    <li class="nav-item dropdown list-unstyled">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-shield me-1"></i>{{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu list-unstyled" aria-labelledby="navbarDropdown2">
                            <li>
                                <form action="{{ route('logout') }}" class="align-self-center ms-5" method="POST">
                                    @csrf
                                    <button type="submit" class="btn">
                                        <span class="me-auto text-center">Sair</span><i class="fas fa-sign-out-alt ms-2"></i>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </div>
</nav>