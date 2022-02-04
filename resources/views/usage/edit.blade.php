@extends('layouts.admin.app')

@section('content')
<div class="container mt-3">
    <h1>Edição de Finalidade</h1>
    <hr>
    <div class="col-md-8 offset-md-2">
        <form action="{{route('usage.update', $usage->id)}}" method="POST">
            @csrf
            @method('PUT')
            <fieldset>
                <div class="row mb-3 form-floating">
                    <input class="form-control" type="text" name="name" id="name" placeholder="" value="{{ $usage->name }}">
                    <label for="name">Nome</label>

                    <span class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Voltar</a>  
                <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Salvar Alterações</button>
            </fieldset>
        </form>
    </div>
</div>
@endsection