@extends('layouts.app')

@php
    use Illuminate\Support\Str;

    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
@endphp

@push('css')
    <style>
        .recipe-container {
            padding-top: 8px;
            margin-top: 20px;
        }
    </style>
@endpush

@if (isset($category))
    @section('title', $category->name . ' | Gusto&Gracia')
@else
    @section('title', '"' . $query . '" | Gusto&Gracia')
@endif

@section('content')
    <div class="recipe-container">
        @if (isset($category))
            <h1>{{ $category->name }}</h1>
        @else
            <h1>{{ __('messages.SearchResultsFor') }} "{{ $query }}"</h1>
        @endif
        <br>
        <div class="recipe-list">
            @if (isset($category))
                @foreach ($recipesByCategory as $recipe)
                    <div class="card recipe-item" link="{{ route('recipe.show', $recipe->id) }}">
                        <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->name }}" class="card-img-top">
                        <div class="card-body">
                            <h3 class="card-title">{{ $recipe->name }}</h3>
                            <p class="card-text">{{ Str::limit($recipe->description, 50) }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                @foreach ($recipes as $recipe)
                    <div class="card recipe-item" link="{{ route('recipe.show', $recipe->id) }}">
                        <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->name }}" class="card-img-top">
                        <div class="card-body">
                            <h3 class="card-title">{{ $recipe->name }}</h3>
                            <p class="card-text">{{ Str::limit($recipe->description, 50) }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const secciones = document.querySelectorAll('.card');
            secciones.forEach(seccion => {
                seccion.addEventListener('click', () => {
                    window.location.href = seccion.getAttribute('link');
                });
            });
        });
    </script>
@endpush
