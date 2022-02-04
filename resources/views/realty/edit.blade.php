@extends('layouts.admin.app')

@section('content')
    <section id="edit">
        <div class="container my-4">
            <h2 class="text-center">Edição de Imóvel</h2>
            <hr class="mb-3">
            <div class="row px-md-5 justify-content-center">
                <form action="{{ route('realty.update', $realty->slug) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <fieldset>
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="name" id="name" placeholder="" value="{{ $realty->name }}">
                                <label for="name">Titulo</label>
    
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
    
                        <div class="col-12 mb-3">
                            <div class="form-group d-flex justify-content-between">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="value" id="value" min=1 oninput="validity.valid||(value='');" placeholder="" value="{{ $realty->value }}">
                                    <label for="value">Valor(R$)</label>
                
                                    <span class="text-danger">
                                        @error('value')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
    
                                <div class="form-floating">
                                    <select name="category_id" class="form-select" id="category_id">
                                        <option value="" selected>Selecione uma Categoria</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @if ($realty->category->name == $category->name) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
            
                                    <span class="text-danger">
                                        @error('category_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
            
                                <div class="form-floating">
                                    <select name="usage_id" class="form-select" id="usage_id">
                                        <option value="" selected>Selecione uma Finalidade</option>
                                        @foreach ($usages as $usage)
                                            <option value="{{ $usage->id }}" @if ($realty->usage->name == $usage->name) selected @endif>{{ $usage->name }}</option>
                                        @endforeach
                                    </select>
            
                                    <span class="text-danger">
                                        @error('usage_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <textarea name="description" class="form-control" id="description" placeholder="">{{ $realty->description }}</textarea>
                                <label for="description">Descrição</label>
    
                                <span class="text-danger">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
    
                        <div class="col-12 mb-3 d-flex justify-content-between">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="rooms" id="rooms" min=1 oninput="validity.valid||(value='');" placeholder="" value="{{ $realty->rooms }}">
                                <label for="rooms">Salas</label>
            
                                <span class="text-danger">
                                    @error('rooms')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
    
                            <div class="form-floating">
                                <input type="number" class="form-control" name="bedrooms" id="bedrooms" min=1 oninput="validity.valid||(value='');" placeholder="" value="{{ $realty->bedrooms }}">
                                <label for="bedrooms">Quartos</label>
            
                                <span class="text-danger">
                                    @error('bedrooms')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
            
                            <div class="form-floating">
                                <input type="number" class="form-control" name="bathrooms" id="bathrooms" min=1 oninput="validity.valid||(value='');" placeholder="" value="{{ $realty->bathrooms }}">
                                <label for="bathrooms">Banheiros</label>
            
                                <span class="text-danger">
                                    @error('bathrooms')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
            
                            <div class="form-floating">
                                <input type="number" class="form-control" name="parking" id="parking" min=1 oninput="validity.valid||(value='');" placeholder="" value="{{ $realty->parking }}">
                                <label for="parking">Garagem</label>
            
                                <span class="text-danger">
                                    @error('parking')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
    
                            <div class="form-floating">
                                <input type="text" class="form-control" name="area" id="area" min=1 oninput="validity.valid||(value='');" placeholder="" value="{{ $realty->area }}">
                                <label for="area">Area(m²)</label>
            
                                <span class="text-danger">
                                    @error('area')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
    
                        <div class="col-12 mb-4">
                            <input type="file" class="form-control" name="photos[]" id="photos" multiple>
            
                            <span class="text-danger">
                                @error('photos.*')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </fieldset>

                    <fieldset>
                        <h2 class="text-center">Endereço</h2>
                        @if (Session::get('fail'))
                            <div class="alert alert-danger w-100 text-center">
                                {{ Session::get('fail') }}
                            </div>
                        @endif
                        <hr class="mb-3">
    
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="street" id="street" placeholder="" value="{{ $realty->adress->street }}">
                            <label for="street">Logradouro</label>
    
                            <span class="text-danger">
                                @error('street')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group d-flex justify-content-between mb-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="number" id="number" placeholder="" value="{{ $realty->adress->number }}">
                                <label for="number">N°</label>
    
                                <span class="text-danger">
                                    @error('number')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
    
                            <div class="form-floating">
                                <input type="text" class="form-control" name="district" id="district" placeholder="" value="{{ $realty->adress->district }}">
                                <label for="district">Bairro</label>
    
                                <span class="text-danger">
                                    @error('district')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
    
                            <div class="form-floating">
                                <input type="text" class="form-control" name="city" id="city" placeholder=""  value="{{ $realty->adress->city }}">
                                <label for="city">Cidade</label>
    
                                <span class="text-danger">
                                    @error('city')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </fieldset>
    
                    <div class="text-center">
                        <button type="submit" class="btn btn-outline-success"><i class="fas fa-save me-2"></i>Salvar</button>
                    </div>
                </form>
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
                                <img src="{{ asset('storage/' . $photo->image_path) }}" class="card-img-top zoom" alt="...">
                                <div class="card-body text-center">
                                    <form action="{{ route('photo.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="photoName" value="{{ $photo->image_path }}">
                    
                                        <button type="submit" class="btn btn-outline-danger">Remover</button>
                                    </form>
                                </div>
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