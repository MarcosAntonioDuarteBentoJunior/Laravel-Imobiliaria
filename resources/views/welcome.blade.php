
@extends('layouts.app')

@section('content')
    <section id="carousel">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-touch="false" data-bs-interval="false">
            <div class="carousel-indicators d-none d-md-flex">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('img/slide-1.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Bem vindo a SN Imobiliária</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse fuga impedit eveniet ratione veniam beatae recusandae voluptatum similique mollitia eius.</p>
                        <button class="btn btn-warning">Saiba Mais</button>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/slide-2.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Bem vindo a SN Imobiliária</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse fuga impedit eveniet ratione veniam beatae recusandae voluptatum similique mollitia eius.</p>
                        <button class="btn btn-warning">Saiba Mais</button>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/slide-3.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Bem vindo a SN Imobiliária</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse fuga impedit eveniet ratione veniam beatae recusandae voluptatum similique mollitia eius.</p>
                        <button class="btn btn-warning">Saiba Mais</button>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev d-none d-md-block" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next d-none d-md-block" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section id="search">
        <div class="container py-4">
            <h2 class="text-center mb-4">Procure seu imóvel ideal.</h2>
            @php
                $cities = App\Models\Adress::all()->pluck('city')->unique();
            @endphp
            <form action="{{ route('realty.search') }}" method="POST" class="row justify-content-between align-self-center">
                @csrf
                <div class="col-12 col-md-6 col-lg-2 mb-3 mb-lg-0">
                    <div class="form-floating">
                        <input type="number" class="form-control" name="rooms" id="rooms" placeholder="" min="1" oninput="validity.valid||(value='');">
                        <label for="rooms">Salas</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 mb-3 mb-lg-0">
                    <div class="form-floating">
                        <input type="number" class="form-control" name="bedrooms" id="bedrooms" placeholder="" min="1" oninput="validity.valid||(value='');">
                        <label for="bedrooms">Quartos</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 mb-3 mb-lg-0">
                    <div class="form-floating">
                        <input type="number" class="form-control" name="bathrooms" id="bathrooms" placeholder="" min="1" oninput="validity.valid||(value='');">
                        <label for="bathrooms">Banheiros</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 mb-3 mb-lg-0">
                    <div class="form-floating">
                        <input type="number" class="form-control" name="parking" id="parking" placeholder="" min="0" oninput="validity.valid||(value='');">
                        <label for="parking">Garagem</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 mb-3 mb-lg-0">
                    <div class="form-floating">
                        <select name="city" class="form-select" id="city">
                            <option value="" selected>Selecione</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city }}">{{ $city }}</option>
                            @endforeach
                        </select>
                        <label for="city">Cidade</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 mb-3 mb-lg-0 align-self-center text-center">
                    <button type="submit" class="btn btn-outline-primary px-3 py-3">Procurar</button>
                </div>
            </form>
        </div>
    </section>

    <section id="main">
        <div class="container mt-4">
            <h2 class="text-center">Imóveis</h2>
            <hr class="mb-3">
            <div class="row justify-content-center">
                @if ($realties->isNotEmpty())
                    @foreach ($realties as $realty)
                        <div class="col-12 col-md-6 col-lg-4 mb-3 mb-md-4">
                            <div class="card">
                                @foreach ($realty->photos as $photo)
                                    <img src="{{ asset('storage/' . $photo->image_path)}}" class="card-img-top" alt="...">
                                    @break
                                @endforeach
                                <div class="card-body">
                                    <h5 class="card-title"> {{ $realty->name }} </h5>
                                    <hr class="mb-3">
                                    <div class="d-flex justify-content-between mb-3">
                                        <div>
                                            R$ {{ number_format($realty->value, 2, ',', '.') }}
                                        </div>
                                        <div>
                                            {{ $realty->category->name }}
                                        </div>
                                        <div>
                                            {{ $realty->usage->name }}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mb-3">
                                        <div>
                                            <a href="{{ route('realty.show', $realty->slug) }}" class="btn btn-primary me-2">Ver mais</a>
                                        </div>

                                        <div @if(!Auth::check() || Auth::user()->cannot('update', $realty)) class="d-none" @endif>
                                            <a href="{{ route('realty.edit', $realty->slug) }}" class="btn btn-secondary me-2">Editar</a>
                                        </div>

                                        <div @if(!Auth::check() || Auth::user()->cannot('delete', $realty)) class="d-none" @endif>
                                            <form action="{{ route('realty.destroy', $realty->slug) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger me-2">Excluir</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between">
                                        <div>
                                            <i class="fas fa-tv me-1"></i>{{ $realty->rooms }}
                                        </div>
                                        <div>
                                            <i class="fas fa-bed me-1"></i>{{ $realty->bedrooms }}
                                        </div>
                                        <div>
                                            <i class="fas fa-bath me-1"></i>{{ $realty->bathrooms }}
                                        </div>
                                        <div>
                                            <i class="fas fa-warehouse me-1"></i>{{ $realty->parking }}
                                        </div>
                                        <div>
                                            <i class="fas fa-vector-square me-1"></i>{{ number_format($realty->area, 2, ',', '.') }} m²
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                        <div class="text-center">
                            <button id="loadMore" class="btn btn-outline-primary">Mostrar mais</button>
                        </div>
                @else
                    <div class="alert alert-info">
                        Nenhum imóvel encontrado.
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container mb-3" data-bs-spy="scroll" data-bs-target="#navbarSupportedContent">
            <div class="row py-5" id="scrollspyHeading1">
                <div class="col-12 col-lg-6 wow animate__animated animate__fadeInUp">
                    <h2 class="mb-3 text-center pb-3 border-bottom border-success">
                        Entre em contato
                    </h2>
                    <form action="{{ route('message') }}" method="POST">
                        @csrf
                        <fieldset class="text-muted">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" id="name" placeholder="">
                                <label for="name">Seu nome...</label>

                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="email" placeholder="">
                                <label for="email">Seu Email...</label>

                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="">
                                <label for="subject">Assunto</label>

                                <span class="text-danger">
                                    @error('subject')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="message" id="message" style="min-height: 180px;" placeholder=""></textarea>
                                <label for="message">Sua mensagem...</label>

                                <span class="text-danger">
                                    @error('message')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-25 mt-3 mb-3">Enviar</button>

                                <div>
                                    @if (Session::get('success'))
                                        <div class="alert alert-success">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="col-12 col-lg-6 mt-5 mt-lg-0 wow animate__animated animate__fadeInRight">
                    <h2 class="mb-3 text-center pb-3 border-bottom border-primary">
                        Como chegar
                    </h2>
                    <iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d947.7693522831258!2d-46.702216523782425!3d-22.610776339928876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c9187a52036ab9%3A0xd808cae31ca61fa5!2sR.%207%20de%20Setembro%20-%20Est%C3%A2ncia%20Su%C3%AD%C3%A7a%2C%20Serra%20Negra%20-%20SP%2C%2013930-000!5e0!3m2!1spt-BR!2sbr!4v1636235497649!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>

    <section id="review">
        <div class="container" data-bs-spy="scroll" data-bs-target="#navbar-scrollspy">
            <h2 id="scrollspyHeading4" class="text-center wow animate__animated animate__slideInLeft mb-5">O que <span>nossos clientes</span> estão dizendo <span>...</span></h2>
            <div id="carouselExampleSlidesOnly" class="carousel slide wow animate__animated animate__fadeInRight" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="5000">
                        <div class="row text-center">
                            <div class="col-12 col-md-6">
                                <img src="{{ asset('img/client-1.jpg') }}" class="img-fluid img-thumbnail rounded-circle mb-3" alt="">
                                <h4 class="mb-3">Juliana Lucena Anes</h4>
                                <p class="mb-3">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </p>
                                <figure>
                                    <blockquote class="blockquote text-muted">
                                        &ldquo; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque impedit modi provident commodi, nam porro. &rdquo;
                                    </blockquote>
                                    <figcaption class="blockquote-footer pt-3">
                                        <cite class="align-items-end">
                                            Cliente desde 2020
                                        </cite>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="col-6 d-none d-md-block">
                                <img src="{{ asset('img/client-2.jpg') }}" class="img-fluid img-thumbnail rounded-circle mb-3" alt="">
                                <h4 class="mb-3">Sílvia Valadão Palmeira</h4>
                                <p class="mb-3">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </p>
                                <figure>
                                    <blockquote class="blockquote text-muted">
                                        &ldquo; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque impedit modi provident commodi, nam porro. &rdquo;
                                    </blockquote>
                                    <figcaption class="blockquote-footer pt-3">
                                        <cite class="align-items-end">
                                            Cliente desde 2020
                                        </cite>
                                    </figcaption>
                                </figure>                                
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <div class="row text-center">
                            <div class="col-12 col-md-6">
                                <img src="{{ asset('img/client-3.jpg') }}" class="img-fluid img-thumbnail rounded-circle mb-3" alt="">
                                <h4 class="mb-3">Stephen Laureano Boto</h4>
                                <p class="mb-3">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </p>
                                <figure>
                                    <blockquote class="blockquote text-muted">
                                        &ldquo; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque impedit modi provident commodi, nam porro. &rdquo;
                                    </blockquote>
                                    <figcaption class="blockquote-footer pt-3">
                                        <cite class="align-items-end">
                                            Cliente desde 2020
                                        </cite>
                                    </figcaption>
                                </figure>                                  
                            </div>
                            <div class="col-6 d-none d-md-block">
                                <img src="{{ asset('img/client-4.jpg') }}" class="img-fluid img-thumbnail rounded-circle mb-3" alt="">
                                <h4 class="mb-3">Ian Galante Bragança</h4>
                                <p class="mb-3">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </p>
                                <figure>
                                    <blockquote class="blockquote text-muted">
                                        &ldquo; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque impedit modi provident commodi, nam porro. &rdquo;
                                    </blockquote>
                                    <figcaption class="blockquote-footer pt-3">
                                        <cite class="align-items-end">
                                            Cliente desde 2020
                                        </cite>
                                    </figcaption>
                                </figure>                                   
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <div class="row text-center">
                            <div class="col-12 col-md-6">
                                <img src="{{ asset('img/client-5.jpg') }}" class="img-fluid img-thumbnail rounded-circle mb-3" alt="">
                                <h4  class="mb-3">Salomão Pedroso Fontoura</h4>
                                <p class="mb-3">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </p>
                                <figure>
                                    <blockquote class="blockquote text-muted">
                                        &ldquo; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque impedit modi provident commodi, nam porro. &rdquo;
                                    </blockquote>
                                    <figcaption class="blockquote-footer pt-3">
                                        <cite class="align-items-end">
                                            Cliente desde 2020
                                        </cite>
                                    </figcaption>
                                </figure>                                
                            </div>
                            <div class="col-6 d-none d-md-block">
                                <img src="{{ asset('img/client-6.jpg') }}" class="img-fluid img-thumbnail rounded-circle mb-3" alt="">
                                <h4  class="mb-3">Iris Lemes Dâmaso</h4>
                                <p class="mb-3">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </p>
                                <figure>
                                    <blockquote class="blockquote text-muted">
                                        &ldquo; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque impedit modi provident commodi, nam porro. &rdquo;
                                    </blockquote>
                                    <figcaption class="blockquote-footer pt-3">
                                        <cite class="align-items-end">
                                            Cliente desde 2020
                                        </cite>
                                    </figcaption>
                                </figure>                                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="team">
        <div class="container mt-4">
            <h2 class="text-center">Nossa Equipe</h2>
            <hr class="mb-3">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3 mb-3 mb-md-4">
                    <div class="card h-100 border-0 text-center">
                        <img src="{{ asset('img/agent-1.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-img-overlay">
                            <div class="d-flex fs-1">
                                <i class="fab fa-whatsapp me-4"></i>
                                <i class="fab fa-instagram me-4"></i>
                                <i class="fab fa-twitter"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Nélia Caetano Passarinho</h5>
                            <p class="card-text">CRECI: 658312</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-3 mb-md-4">
                    <div class="card h-100 border-0 text-center">
                        <img src="{{ asset('img/agent-2.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-img-overlay">
                            <div class="d-flex fs-1">
                                <i class="fab fa-whatsapp me-4"></i>
                                <i class="fab fa-instagram me-4"></i>
                                <i class="fab fa-twitter"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Ester Chaves Saraiva</h5>
                            <p class="card-text">CRECI: 678312</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-3 mb-md-4">
                    <div class="card h-100 border-0 text-center">
                        <img src="{{ asset('img/agent-3.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-img-overlay">
                            <div class="d-flex fs-1">
                                <i class="fab fa-whatsapp me-4"></i>
                                <i class="fab fa-instagram me-4"></i>
                                <i class="fab fa-twitter"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Matthias Bastos Assunção</h5>
                            <p class="card-text">CRECI: 698312</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-3 mb-md-4">
                    <div class="card h-100 border-0 text-center">
                        <img src="{{ asset('img/agent-4.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-img-overlay">
                            <div class="d-flex fs-1">
                                <i class="fab fa-whatsapp me-4"></i>
                                <i class="fab fa-instagram me-4"></i>
                                <i class="fab fa-twitter"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Kévim Albernaz Mamouros</h5>
                            <p class="card-text">CRECI: 778312</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <!-- JQUERY CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".content").slice(0, 9).show();
            if($(".content:hidden").length == 0) {
                    $("#loadMore").addClass("no-content");
                }
            $("#loadMore").on("click", function(e){
                e.preventDefault();
                $(".content:hidden").slice(0, 6).slideDown();
                if($(".content:hidden").length == 0) {
                    $("#loadMore").addClass("no-content");
                }
            });
        });
    </script>
@endsection