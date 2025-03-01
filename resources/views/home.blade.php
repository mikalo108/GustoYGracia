@extends('layouts.app')

@php
    use Illuminate\Support\Str;
@endphp

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
    @auth
    <h1>¡{{ __('messages.Welcome') }}, {{ Auth::user()->name }}!</h1>
    <a href="{{ route('dashboard') }}">Ir al panel de control</a>
    @endauth

    @guest
        <h2>{{ __('messages.Welcome') }}, {{ __('messages.Visitor') }}!</h2>
    @endguest
    
    <br/><p>{{ __('messages.HomeMessage') }}</p>

    <!-- Mostrar las recetas -->
    <div class="recipe-container">
        <h2>{{ __('messages.LastRecipes') }}</h2>
        <div class="recipe-list">
            @foreach ($recipesList as $recipe)
                <div class="recipe-item">
                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->name }}"
                        style="width: 100%; height: auto;">
                    <h3>{{ $recipe->name }}</h3>
                    <p>{{ Str::limit($recipe->description, 100) }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
