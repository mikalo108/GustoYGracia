@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
@endphp

@push('css')
    <!-- estilos adicionales -->
    <style>

    </style>
@endpush

@section('title', 'Recipe Index')

@section('content')
    @if (Auth::check() && Auth::user()->email === 'admin@gustoygracia.com')
        <div class="row mb-5">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="row">
                                <h1>DB Table Recipe</h1>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <form action="" method="post" class="search-form">
                                @csrf
                                <label for="recipeName" class="form-label"> Recipe Name</label>
                                <input id="recipeName" name="recipeName" class="form-control"
                                    value="@isset($recipeName) {{ $recipeName }}
                        @endisset"
                                    placeholder="" />

                                <label for="recipeDescription" class="form-label"> Recipe Description </label>
                                <input id="recipeDescription" name="recipeDescription" class="form-control"
                                    value="@isset($recipeDescription) {{ $recipeDescription }}
                        @endisset"
                                    placeholder="" />

                                <label for="recipeCategory" class="form-label"> Recipe category</label>
                                <input id="recipeCategory" name="recipeCategory" class="form-control"
                                    value="@isset($recipeCategory) {{ $recipeCategory }}
                        @endisset"
                                    placeholder="" />

                                <br><button type="submit" class="btn btn-primary"><img width="20" src="{{ asset('images/lupa-icon.png') }}" alt="Buscar"></button>
                            </form>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <a id="createIcon" class="header__link btn btn-sm btn-success"
                                href="{{ route('recipe.create') }}"><span>+</span></a>
                        </div>
                        <div class="table-responsive mt-3">
                            @if (count($recipes) > 0)
                                <table class="table table-striped align-items-center">
                                    <thead class="thead-light">
                                        <th>#</th>
                                        <th>{{ __('columns.Name') }}</th>
                                        <th>Descripción</th>
                                        <th>Categorías</th>
                                        <th>Usuario</th>
                                        <th>created_at</th>
                                        <th>updated_at</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($recipes as $recipe)
                                            <tr>
                                                <td>{{ $recipe->id }}</td>
                                                <td>{{ $recipe->name }}</td>
                                                <td class="descripcion">{{ $recipe->description }}</td>
                                                <td>
                                                    @foreach ($recipe->categories as $category)
                                                        <ul class="nav flex-column" class="categoriasLista">
                                                            <li id="tagCategory"
                                                                class="flex-sm-fill text-sm-center badge rounded-pill text-bg-success">
                                                                {{ $category->name }}</li>
                                                        </ul>
                                                    @endforeach
                                                </td>
                                                <td>{{ $recipe->user->name }}</td>
                                                <td>{{ $recipe->created_at }}</td>
                                                <td>{{ $recipe->updated_at }}</td>

                                                <td>
                                                    <div class="btn-group actions" role="group" aria-label="Recipe">
                                                        <div class="btn">
                                                            <a class="btn btn-secondary" href="{{ route('recipe.edit', $recipe) }}">
                                                                <img class="editButton" src="{{ asset('images/pencil-solid.svg') }}" alt="Edit">
                                                            </a>
                                                        </div>
                                                        <form class="btn" action="{{route('recipe.destroy', $recipe->id)}}" method="POST">
                                                            @csrf
                                                            @method("DELETE")
                                                            <a class="btn btn-danger botonBorrar">
                                                                <img class="editButton" src="{{ asset('images/trash-solid.svg') }}" alt="Delete">
                                                            </a>
                                                        </form>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-warning mt-3">
                                    No hay recetas
                                </div>
                            @endif
                        </div>
                        <div class="row my-3 pr-3">
                            <div class="col">
                                <div class="float-right">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else

    @endif

    @endsection
