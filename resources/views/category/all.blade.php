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

@section('title', 'Category Index')

@section('content')
    @if (Auth::check() && Auth::user()->email === 'admin@gustoygracia.com')
        <div class="row mb-5">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="row">
                                <h1>{{ __("admin.Table") }}: {{ __("admin.TitleCategoriesTable") }}</h1>
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <form action="" method="post" class="search-form">
                                @csrf
                                <div>
                                    <label for="categoryName" class="form-label"> {{ __("admin.TitleCategoryTable") }} {{ __('columns.category_1') }}</label>
                                    <input id="categoryName" name="categoryName" class="form-control" value="@isset($categoryName) {{ $categoryName }}@endisset"/>
                                </div>
                                <div>
                                    <label for="categoryDescription" class="form-label"> {{ __("admin.TitleCategoryTable") }} {{ __('columns.category_2') }}</label>
                                    <input id="categoryDescription" name="categoryDescription" class="form-control" value="@isset($recipeDescription) {{ $recipeDescription }} @endisset"/>
                                </div>
                                <button type="submit" id="botonBuscar" class="btn btn-primary"><img width="20" src="{{ asset('images/lupa-icon-solid-white.svg') }}" alt="Search"></button>
                            </form>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <a id="createIcon" class="header__link btn btn-sm btn-success"
                                href="{{ route('category.create') }}"><img width="30" src="{{ asset('images/plus-solid.svg') }}" alt="New"></a>
                        </div>
                        <div class="table-responsive mt-3">
                            @if (count($categoryList) > 0)
                                <table class="table table-striped align-items-center">
                                    <thead class="thead-light">
                                        <th>#</th>
                                        <th>{{ __('columns.category_1') }}</th>
                                        <th>{{ __('columns.category_2') }}</th>
                                        <th>{{ __('columns.created_at') }}</th>
                                        <th>{{ __('columns.updated_at') }}</th>
                                        <th>{{ __('columns.actions') }}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($categoryList as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td class="descripcion">{{ $category->description }}</td>
                                                <td>{{ $category->created_at }}</td>
                                                <td>{{ $category->updated_at }}</td>

                                                <td>
                                                    <div class="btn-group actions" role="group" aria-label="Category">
                                                        <div class="btn">
                                                            <a class="btn btn-secondary" href="{{ route('category.edit', $category) }}">
                                                                <img class="editButton" src="{{ asset('images/pencil-solid.svg') }}" alt="Edit">
                                                            </a>
                                                        </div>
                                                        <form class="btn" action="{{route('category.destroy', $category->id)}}" method="POST">
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
                                    {{ $categoryList->links('pagination::bootstrap-5') }}
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
