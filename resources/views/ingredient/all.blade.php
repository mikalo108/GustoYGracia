@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }

    $title = __('admin.TitleIngredientsTable'); 
    if(Auth::check() && Auth::user()->email === 'admin@gustoygracia.com') {
        $title = $title.' '. __('admin.Index');
    }
@endphp

@push('css')
    <!-- estilos adicionales -->
    <style>

    </style>
@endpush

@section('title', $title)

@section('content')
    @if (Auth::check() && Auth::user()->email === 'admin@gustoygracia.com')
        <div class="row mb-5">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="row">
                                <h1>{{ __("admin.Table") }}: {{ __("admin.TitleIngredientsTable") }}</h1>
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <form action="" method="post" class="search-form">
                                @csrf
                                <div>
                                    <label for="ingredientName" class="form-label"> {{ __("admin.TitleIngredientTable") }} {{ __('columns.ingredient_1') }}</label>
                                    <input id="ingredientName" name="ingredientName" class="form-control" value="@isset($ingredientName) {{ $ingredientName }}@endisset"/>
                                </div>
                                <div>
                                    <label for="ingredientDescription" class="form-label"> {{ __("admin.TitleIngredientTable") }} {{ __('columns.ingredient_2') }}</label>
                                    <input id="ingredientDescription" name="ingredientDescription" class="form-control" value="@isset($ingredientDescription) {{ $ingredientDescription }} @endisset"/>
                                </div>
                                <div>
                                    <label for="ingredientCalories" class="form-label"> {{ __("admin.TitleIngredientTable") }} {{ __('columns.ingredient_2') }}</label>
                                    <input id="ingredientCalories" name="ingredientCalories" class="form-control" value="@isset($ingredientCalories) {{ $ingredientCalories }} @endisset"/>
                                </div>
                                <button type="submit" id="botonBuscar" class="btn btn-primary"><img width="20" src="{{ asset('images/lupa-icon-solid-white.svg') }}" alt="Search"></button>
                            </form>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <a id="createIcon" class="header__link btn btn-sm btn-success"
                                href="{{ route('ingredient.create') }}"><img width="30" src="{{ asset('images/plus-solid.svg') }}" alt="New"></a>
                        </div>
                        <div class="table-responsive mt-3">
                            @if (count($ingredientList) > 0)
                                <table class="table table-striped align-items-center">
                                    <thead class="thead-light">
                                        <th>#</th>
                                        <th>{{ __('columns.ingredient_1') }}</th>
                                        <th>{{ __('columns.ingredient_2') }}</th>
                                        <th>{{ __('columns.ingredient_3') }}</th>
                                        <th>{{ __('columns.created_at') }}</th>
                                        <th>{{ __('columns.updated_at') }}</th>
                                        <th>{{ __('columns.actions') }}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($ingredientList as $ingredient)
                                            <tr class="filaTablaIndex" link="{{ route('ingredient.show', $ingredient->id) }}">
                                                <td>{{ $ingredient->id }}</td>
                                                <td>{{ $ingredient->name }}</td>
                                                <td class="descripcion">{{ $ingredient->description }}</td>
                                                <td>{{ $ingredient->calories_per_100g }}</td>
                                                <td>{{ $ingredient->created_at }}</td>
                                                <td>{{ $ingredient->updated_at }}</td>

                                                <td>
                                                    <div class="btn-group actions" role="group" aria-label="Ingredient">
                                                        <div class="btn">
                                                            <a class="btn btn-secondary" href="{{ route('ingredient.edit', $ingredient) }}">
                                                                <img class="editButton" src="{{ asset('images/pencil-solid.svg') }}" alt="Edit">
                                                            </a>
                                                        </div>
                                                        <form class="btn" action="{{route('ingredient.destroy', $ingredient->id)}}" method="POST">
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
                                    {{ __('admin.noData') }}
                                </div>
                            @endif
                        </div>
                        <div class="row my-3 pr-3">
                            <div class="col">
                                <div class="float-right">
                                    {{ $ingredientList->links('pagination::bootstrap-5') }}
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
