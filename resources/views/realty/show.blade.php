@extends('layouts.app')

@section('content')
<section id="info">
    <div class="container mt-4 py-3 text-white">
        @if (Session::get('success'))
            <div class="alert alert-success w-100 text-center">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12 col-md-5 col-lg-4">
                @foreach ($realty->photos as $photo)
                    <img src="{{ asset('storage/' . $photo->image_path)}}" class="card-img-top h-100" alt="...">
                @break
            @endforeach
            </div>
            <div class="col-12 col-md-7 col-lg-8 py-3 text-dark">
                <h2 class="mb-3 text-uppercase">
                    {{ $realty->name }}
                </h2>
                <p class="mb-3">
                    {{ $realty->description }}
                </p>
                <div class="text-center d-flex justify-content-between mb-4">
                    <div>
                        <i class="fas fa-tv me-1"></i>{{ $realty->rooms }} sala(s)
                    </div>

                    <div>
                        <i class="fas fa-bed me-1"></i>{{ $realty->bedrooms }} quarto(s)
                    </div>

                    <div>
                        <i class="fas fa-bath me-1"></i>{{ $realty->bathrooms }} banheiro(s)
                    </div>

                    <div>
                        <i class="fas fa-warehouse me-1"></i>{{ $realty->parking }} vaga(s) de garagem
                    </div>

                    <div>
                        <i class="fas fa-vector-square me-1"></i>{{ number_format($realty->area, 2, ',', '.') }} m²
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="me-5">
                        <p class="text-primary">Valor: R$ {{ number_format($realty->value, 2, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-warning">
                            {{ $realty->category->name }} | {{ $realty->usage->name }}
                        </p>
                    </div>
                </div>

                <a href="{{ route('appointment', $realty->slug )}}" class="btn btn-warning px-3 py-3">
                    <i class="fas fa-edit"></i> <span class="align-self-center">Agende uma visita</span>
                </a>
            </div>
        </div>
    </div>
</section>

<section id="gallery">
    <div class="container mt-5">
        <h2 class="text-center">Fotos</h2>
        <hr class="mb-3">
        <div class="row justify-content-around">
            @if ($realty->photos->isEmpty())
                <div class="alert alert-info">
                    Este imóvel naõ possui fotos.
                </div>
            @else
                @foreach ($realty->photos as $photo)
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-3 mb-md-4">
                        <div class="card h-100 border-0">
                            <img src="{{ asset('storage/' . $photo->image_path)}}" class="card-img-top zoom" alt="...">
                            @if (Auth::check() && Auth::user()->can('delete', $photo))
                                <div class="card-body text-center">
                                    <form action="{{ route('photo.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="photoName" value="{{$photo->image_path}}">
                    
                                        <button type="submit" class="btn btn-outline-danger">Remover</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script src="{{ asset('js/medium-zoom.min.js') }}"></script>
    <script>
        mediumZoom('.zoom', {
            margin: 50,
            background: '#000'
        })
    </script>
@endsection