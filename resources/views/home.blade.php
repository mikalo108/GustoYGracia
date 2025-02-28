@extends('layouts.app')

<?php
if (Session::has('locale')) {
    App::setLocale(Session::get('locale'));
}
?>

@push('css')
    <!-- estilos adicionales -->
    <style>

    </style>
@endpush

@section('title', 'Home')

@section('content')
    <h1>{{ __('messages.Welcome') }}</h1>
    <p>{{ __('messages.HomeMessage') }}</p>
    <!-- Puedes agregar más contenido aquí -->

    <p>Idioma actual: {{ app()->getLocale() }}</p>

    <form action="{{ route('e') }}" method="GET">
        @csrf
        <button type="submit">No borrar este botón</button>
    </form>

    <!-- Mostrar las recetas -->
    <div class="recipe-container">
        <h2>{{ __('messages.LastRecipes') }}</h2>
        <div class="recipe-list">
            @foreach ($recipesList as $recipe)
                <div class="recipe-item">
                    <!-- Suponiendo que cada receta tiene una foto y un nombre -->
                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->name }}"
                        style="width: 100%; height: auto;">
                    <h3>{{ $recipe->name }}</h3>
                    <p>{{ Str::limit($recipe->description, 100) }}</p>
                </div>
            @endforeach
        </div>
    </div>

@endsection
