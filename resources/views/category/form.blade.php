@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
    if(isset($category->name)){
        $title=__('admin.Edit').' '.$category->name;
    } else{
        $title=__('admin.Create').' '.__('admin.TitleCategoryTable');
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
                            @isset($category)
                                <form name="edit_category" action="{{ route('category.update', $category) }}" method="post">
                                @csrf
                            @else
                                <form name="create_category" action="{{ route('category.store') }}" method="post">
                                @csrf
                            @endisset
                                <div class="mb-3">
                                    <label for="categoryNameES" class="form-label"> {{__('columns.category_1')}}__es</label>
                                    <input id="categoryNameES" name="categoryNameES" type="text"
                                    class="form-control" required @isset($cES) value="{{$cES->name}}" @endisset />
                                </div>
                                <div class="mb-3">
                                    <label for="categoryNameEN" class="form-label"> {{__('columns.category_1')}}__en</label>
                                    <input id="categoryNameEN" name="categoryNameEN" type="text"
                                    class="form-control" required @isset($cEN) value="{{$cEN->description}}" @endisset />
                                </div>
                                <div class="mb-3">
                                    <label for="categoryDescriptionES" class="form-label"> {{__('columns.category_2')}}__es</label>
                                    <input id="categoryDescriptionES" name="categoryDescriptionES" type="text"
                                    class="form-control" required @isset($cES) value="{{$cES->name}}" @endisset />
                                </div>
                                <div class="mb-3">
                                    <label for="categoryDescriptionEN" class="form-label"> {{__('columns.category_2')}}__en</label>
                                    <input id="categoryDescriptionEN" name="categoryDescriptionEN" type="text"
                                    class="form-control" required @isset($cEN) value="{{$cEN->description}}" @endisset />
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
