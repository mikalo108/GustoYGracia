@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
    if(isset($ingredient->name)){
        $title=__('admin.Edit').' '.$ingredient->name;
    } else{
        $title=__('admin.Create').' '.__('admin.TitleIngredientTable');
    }
@endphp

@push('css')
    <!-- estilos adicionales -->
    <style>
        form{
            flex-direction: column;
        }
        form>input[type="submit"]{
            align-self: flex-start;
        }
    </style>
@endpush

@section("title", $title)

@section('content')
    @if (Auth::check() && Auth::user()->email === 'admin@gustoygracia.com')
        <div class="row mb-5">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="row">
                                <h1>{{ $title }}</h1>
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            @isset($ingredient)
                                <form name="edit_ingredient" action="{{ route('ingredient.update', $ingredient->id) }}" method="post">
                                @csrf
                            @else
                                <form name="create_ingredient" action="{{ route('ingredient.store') }}" method="post">
                                @csrf
                            @endisset
                                <div class="mb-3">
                                    <label for="name" class="form-label"> {{__('columns.ingredient_1')}}</label>
                                    <input id="name" name="name" type="text"
                                    class="form-control" required @isset($ingredient) value="{{$ingredient->name}}" @endisset />
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label"> {{__('columns.ingredient_2')}}</label>
                                    <input id="description" name="description" type="text"
                                    class="form-control" required @isset($ingredient) value="{{$ingredient->description}}" @endisset />
                                </div>
                                <div class="mb-3">
                                    <label for="calories_per_100g" class="form-label"> {{__('columns.ingredient_3')}}</label>
                                    <input id="calories_per_100g" name="calories_per_100g" type="text"
                                    class="form-control" required @isset($ingredient) value="{{$ingredient->calories_per_100g}}" @endisset />
                                </div>
                                <input type="submit" value="{{__('admin.save_btn')}}" class="btn btn-primary" name="saveBtn"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else

    @endif

    @endsection
