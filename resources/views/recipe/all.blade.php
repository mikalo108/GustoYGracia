@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }

    $title = __('admin.TitleRecipesTable'); 
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
                                <h1>{{ __("admin.Table") }}: {{ __("admin.TitleRecipesTable") }}</h1>
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <form action="{{ route('recipe.index') }}" method="get" class="search-form" id="formBusqueda">
                                @csrf
                                <div>
                                    <label for="recipeName" class="form-label"> {{ __("admin.TitleRecipeTable") }} {{ __('columns.recipe_1') }}</label>
                                    <input type="text" id="recipeName" name="recipeName" class="form-control"
                                    value="@isset($recipeName) {{ $recipeName }}@endisset"/>
                                </div>
                                <div>
                                    <label for="recipeDescription" class="form-label"> {{ __("admin.TitleRecipeTable") }} {{ __('columns.recipe_2') }}</label>
                                    <input type="text" id="recipeDescription" name="recipeDescription" class="form-control" value="@isset($recipeDescription){{$recipeDescription}}@endisset"/>
                                </div>
                                <div>
                                    <label for="recipeCategory" class="form-label"> {{ __("admin.TitleRecipeTable") }} {{ __('columns.recipe_3') }}</label>
                                    <input type="text" id="recipeCategory" name="recipeCategory" class="form-control" value="@isset($recipeCategory){{$recipeCategory}}@endisset"/>
                                </div>
                                <div>
                                    <label for="recipeUser" class="form-label"> {{ __("admin.TitleRecipeTable") }} {{ __('columns.recipe_4') }}</label>
                                    <input type="text" id="recipeUser" name="recipeUser" class="form-control" value="@isset($recipeUser){{$recipeUser}}@endisset"/>
                                </div>
                                <button type="submit" id="botonBuscar" class="btn btn-primary"><img width="20" src="{{ asset('images/lupa-icon-solid-white.svg') }}" alt="Search"></button>
                                <input 
                                    @if(isset($recipeName)||isset($recipeDescription)||isset($recipeCategory)||isset($recipeUser))
                                        style="visibility: visible;justify-self: right;"
                                    @else 
                                        style="visibility: hidden;justify-self: right;" 
                                    @endif 
                                    class="btn btn-danger" id="vaciarCampos" type="button" value="{{ __('admin.clearFields') }}"
                                >
                            </form>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <a id="createIcon" class="header__link btn btn-sm btn-success"
                                href="{{ route('recipe.create') }}"><img width="30" src="{{ asset('images/plus-solid.svg') }}" alt="New"></a>
                        </div>
                        <div class="table-responsive mt-3">
                            @if (count($recipeList) > 0)
                                <table class="table table-striped align-items-center">
                                    <thead class="thead-light">
                                        <th>#</th>
                                        <th>{{ __('columns.recipe_1') }}</th>
                                        <th>{{ __('columns.recipe_2') }}</th>
                                        <th>{{ __('columns.recipe_3') }}</th>
                                        <th>{{ __('columns.recipe_4') }}</th>
                                        <th>{{ __('columns.created_at') }}</th>
                                        <th>{{ __('columns.updated_at') }}</th>
                                        <th>{{ __('columns.actions') }}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($recipeList as $recipe)
                                            <tr class="filaTablaIndex" link="{{ route('recipe.show', $recipe->id) }}">
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
                                    {{ __('admin.noData') }}
                                </div>
                            @endif
                        </div>
                        <div class="row my-3 pr-3">
                            <div class="col">
                                <div class="float-right">
                                    {{ $recipeList->links('pagination::bootstrap-5') }}
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
