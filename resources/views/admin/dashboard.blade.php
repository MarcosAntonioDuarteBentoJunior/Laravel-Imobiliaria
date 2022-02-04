@extends('layouts.admin.app')

@section('content')
    <section id="results">
        <div class="container mt-3">
            <div class="row">
                @if (Session::get('success'))
                    <div class="alert alert-success text-center">
                        {{ Session::get('success') }}
                    </div>
                @endif
    
                @if (Session::get('fail'))
                    <div class="alert alert-danger text-center">
                        {{ Session::get('fail') }}
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section id="categories">
        <div class="container mt-3">
            <h2 class="text-center">Categorias</h2>
            <hr class="mb-3 text-primary">
            <div class="row">
                @if ($categories->isEmpty())
                    <div class="alert alert-info">
                        Não existem categorias para listar.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped justify-content-around">
                            <thead>
                                <th scope="col">Categoria</th>
                                <th scope="col">Imóveis Cadastrados</th>
                                <th scope="col">Criado em</th>
                                <th scope="col">Ações</th>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->realties->count() }}</td>
                                        <td>{{ date('d/m/Y', strtotime($category->created_at)) }}</td>
                                        <td>
                                            <a href="{{ route('category.edit', $category->id) }}" class="text-decoration-none">
                                                <i class="fas fa-pencil-alt me-2" title="Editar"></i>
                                            </a>

                                            <a href="#" class="text-decoration-none text-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $category->id }}">
                                                <i class="fas fa-trash" title="Excluir"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Confirmar Ação</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Tem certeza que deseja remover a categoria {{ $category->name }} ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('category.destroy', $category->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-outline-danger">Confirmar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="justify-content-start">
                    <a href="{{ route('category.create') }}" class="btn btn-success mb-2">Nova Categoria</a>
                </div>
                <div class="text-center mt-3">
                    {!! $categories->links() !!}
                </div>
            </div>
        </div>
    </section>

    <section id="usages">
        <div class="container mt-3">
            <div class="row">
                <h2 class="text-center">Finalidades</h2>
                <hr class="mb-3 text-primary">
                @if ($usages->isEmpty())
                    <div class="alert alert-info">
                        Não existem finalidades para listar.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped justify-content-around">
                            <thead>
                                <th scope="col">Finalidade</th>
                                <th scope="col">Imóveis Cadastrados</th>
                                <th scope="col">Criado em</th>
                                <th scope="col">Ações</th>
                            </thead>
                            <tbody>
                                @foreach ($usages as $usage)
                                    <tr>
                                        <td>{{ $usage->name }}</td>
                                        <td>{{ $usage->realties->count() }}</td>
                                        <td>{{ date('d/m/Y', strtotime($usage->created_at)) }}</td>
                                        <td>
                                            <a href="{{ route('usage.edit', $usage->id) }}" class="text-decoration-none">
                                                <i class="fas fa-pencil-alt me-2" title="Editar"></i>
                                            </a>

                                            <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $usage->id * 10 }}">
                                                <i class="fas fa-trash text-danger"title="Excluir"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $usage->id * 10 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Confirmar Ação</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Tem certeza que deseja remover a finalidade {{ $usage->name }} ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('usage.destroy', $usage->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-outline-danger">Confirmar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="justify-content-start">
                    <a href="{{ route('usage.create') }}" class="btn btn-success mb-2">Nova Finalidade</a>
                </div>
                <div class="text-center mt-4">
                    {!! $usages->links() !!}
                </div>
            </div>
        </div>
    </section>

@endsection