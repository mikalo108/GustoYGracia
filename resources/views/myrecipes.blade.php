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
        }
    </style>
@endpush

@section('title', __('messages.MyRecipes') . ' | Gusto&Gracia')

@section('content')
    <div class="recipe-container">
        <h1>{{ __('messages.MyRecipes') }}</h1>

        <!-- Botón para Crear receta -->
        <div class="create-recipe-btn-container">
            <a href="{{ route('recipe.userCreate') }}" class="create-recipe-btn">
                +
            </a>
        </div>

        <br>
        <div class="recipe-list">
            @foreach ($recipeList as $recipe)
                <div class="card recipe-item" link="{{ route('recipe.show', $recipe->id) }}">
                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->name }}" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title">{{ $recipe->name }}</h3>
                        <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                    </div>
                </div>
            @endforeach
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
        })
    </script>
@endpush
