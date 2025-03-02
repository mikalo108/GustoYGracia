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
            <div class="card text-bg-ligth" link="/recipe">
                <div class="card-body">
                    <h5 class="card-title">{{ __('admin.TitleRecipesTable') }}</h5>
                    <p class="card-text">{{ __('admin.DescriptionRecipeTable') }}</p>
                </div>
            </div>
            <button class="card text-bg-ligth" style="text-align:left" href="{{ route('category.index') }}">
                <div class="card-body">
                    <h5 class="card-title">{{ __('admin.TitleCategoriesTable') }}</h5>
                    <p class="card-text">{{ __('admin.DescriptionCategoryTable') }}</p>
                </div>
            </button>
            <div class="card text-bg-ligth" link="/ingredient">
                <div class="card-body">
                    <h5 class="card-title">{{ __('admin.TitleIngredientsTable') }}</h5>
                    <p class="card-text">{{ __('admin.DescriptionIngredientTable') }}</p>
                </div>
            </div>
            <div class="card text-bg-ligth" link="/user">
                <div class="card-body">
                    <h5 class="card-title">{{ __('admin.TitleUsersTable') }}</h5>
                    <p class="card-text">{{ __('admin.DescriptionUserTable') }}</p>
                </div>
            </div>
            <div class="card text-bg-ligth" link="/contact">
                <div class="card-body">
                    <h5 class="card-title">{{ __('admin.TitleContactsTable') }}</h5>
                    <p class="card-text">{{ __('admin.DescriptionContactTable') }}</p>
                </div>
            </div>
            <div class="card text-bg-ligth" link="/comment">
                <div class="card-body">
                    <h5 class="card-title">{{ __('admin.TitleCommentsTable') }}</h5>
                    <p class="card-text">{{ __('admin.DescriptionCommentTable') }}</p>
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
