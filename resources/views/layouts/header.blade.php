<nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
    <div class="container">
        <a class="navbar-brand align-items-center" href="{{ route('home') }}"><img src="{{ asset('/img/logo.png')}}" class="img-fluid me-3" alt="logo">Imobiliária</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Imóveis
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @php
                            $categories = App\Models\Category::all();
                            $usages = App\Models\Usage::all();
                        @endphp

                        @foreach ($categories as $category)
                            <li><a class="dropdown-item" href="{{ route('realty.category', $category->id) }}">{{ $category->name }}</a></li>
                        @endforeach

                        @auth
                            @if (!strcmp(Auth::user()->role, 'admin'))
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('realty.create') }}">Novo imóvel</a></li>
                            @endif
                        @endauth
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Negócios
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        @php
                            $usages = App\Models\Usage::all();
                        @endphp

                        @foreach ($usages as $usage)
                            <li><a class="dropdown-item" href="{{ route('realty.usage', $usage->id) }}">{{ $usage->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" @if(!Route::is('home')) style="display: none;" @endif href="#scrollspyHeading1">Contato</a>
                </li>
            </ul>
            <div class="d-flex">
                @if (Auth::check())
                    @if (!strcmp(Auth::user()->role, 'admin'))
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
                    @else
                        <div>
                            <li class="nav-item dropdown list-unstyled">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-tag me-1"></i>{{ Auth::user()->name }}
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
                    @endif
                @else
                    <div class="me-3">
                        <a href="{{ route('login') }}" class="text-decoration-none">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('register') }}" class="text-decoration-none">
                            <i class="fas fa-user me-1"></i>Cadastre-se
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>