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
    <!-- estilos adicionales -->
    <style>
        .container {
            margin-top: 50px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: auto;
            gap: 30px;
        }

        .container>div {
            -webkit-user-drag: none;
            user-select: none;
        }

        .container>div:hover {
            background-color: #f0f0f0;
            cursor: pointer;
        }
    </style>
@endpush

@section('title', 'Home')

@section('content')
    @if (Auth::check() && Auth::user()->email === 'admin@gustoygracia.com')
        <h1>Admin Home</h1>
        <hr>
        <div class="container">
            <div class="card text-bg-ligth" link="/admin/recipe">
                <div class="card-body">
                    <h5 class="card-title">Recetas</h5>
                    <p class="card-text">Aquí se gestionan las recetas</p>
                </div>
            </div>
        </div>
    @else
        @auth
            <h1>¡{{ __('messages.Welcome') }}, {{ Auth::user()->name }}!</h1>
            <a href="{{ route('dashboard') }}">Ir al panel de control</a>
        @endauth

        @guest
            <h2>{{ __('messages.Welcome') }}, {{ __('messages.Visitor') }}!</h2>
        @endguest

        <br />
        <p>{{ __('messages.HomeMessage') }}</p>

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
    @endif
@endsection

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
