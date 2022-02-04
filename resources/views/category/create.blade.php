@extends('layouts.admin.app')

@section('content')
<div class="container mt-3">
    <h1>Cadastro de Categoria</h1>
    <hr>
    <div class="col-md-8 offset-md-2">
        <form action="{{route('category.store')}}" method="POST">
            @csrf
            <fieldset>
                <div class="row mb-3 form-floating">
                    <input class="form-control" type="text" name="name" id="name" placeholder="">
                    <label for="name">Nome</label>

                    <span class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Voltar</a>  
                <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Salvar</button>
            </fieldset>
        </form>
    </div>
</div>
@endsection