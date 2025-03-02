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
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else

    @endif

    @endsection
