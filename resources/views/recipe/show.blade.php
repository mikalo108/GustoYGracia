@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
@endphp

@push('css')
    <style>
        h3,
        h4 {
            font-size: 1.3em;
            color: #16404D;
            margin-bottom: 10px;
        }
    </style>
@endpush

@section('title', $recipe->name . ' | Gusto&Gracia')

@section('content')
    <div id="recipe-container">
        <!-- Título de la receta -->
        <h1 class="recipe-title">{{ $recipe->name }}</h1>

        <!-- Imagen de la receta -->
        <div class="recipe-image-container">
            <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->name }}" class="recipe-image">
        </div>


        <!-- Categorías -->
        <div class="recipe-categories">
            <h4>Categorías:</h4>
            <ul>
                @foreach ($categories as $category)
                    @if ($recipe->categories->contains($category->id))
                        <p>{{ $category->name }}</p>
                    @endif
                @endforeach
            </ul>
        </div>

        <!-- Descripción de la receta -->
        <div class="recipe-description">
            <h3>Descripción:</h3>
            <p>{{ $recipe->description }}</p>
        </div>

        <!-- Ingredientes -->
        <div class="recipe-ingredients">
            <h4>Ingredientes:</h4>
            <ul>
                @foreach ($ingredients as $ingredient)
                    @if ($recipe->ingredients->contains($ingredient->id))
                        <p>{{ $ingredient->name }}</p>
                    @endif
                @endforeach
            </ul>
        </div>

        <!-- Descripción de la receta -->
        <div class="recipe-description">
            <h3>Instrucciones:</h3>
            <p>{{ $recipe->instructions }}</p>
        </div>
        <br>
    </div>

    <!-- Sección de comentarios -->
    <div class="comments-section">
        <h4>Comentarios</h4>
        <div class="comments-list">
            @if ($recipe->comments->count() > 0)
                @foreach ($recipe->comments as $comment)
                    <div class="comment-item">
                        <strong>
                            <a href="{{ route('user.show', $comment->user->id) }}" class="user-link">
                                {{ $comment->user->name }}
                            </a>
                        </strong>
                        @if ($comment->created_at)
                            <span class="comment-date">({{ $comment->created_at->diffForHumans() }})</span>
                        @endif
                        @if (Auth::check() && Auth::user()->id === $comment->user_id)
                            <form
                                action="{{ route('comment.removeComment', ['recipe' => $recipe, 'comment' => $comment->id]) }}"
                                method="POST" class="delete-comment-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-comment-btn">
                                    <img src="{{ asset('images/trash-comments.png') }}" alt="Borrar comentario"
                                        class="delete-icon">
                                </button>
                            </form>
                        @endif
                        <p class="comment-text">{{ $comment->content }}</p>
                    </div>
                @endforeach
            @else
                <p class="no-comments">No hay comentarios aún. Sé el primero en comentar.</p>
            @endif
        </div>
    </div>

    <!-- Formulario para agregar un comentario -->
    @auth
        <div class="comment-form-container">
            <h4>Agregar un comentario</h4>
            <form action="{{ route('recipe.comment.store', ['recipe' => $recipe->id, 'user' => Auth::user()->id]) }}"
                method="POST">
                @csrf
                <textarea name="content" placeholder="Escribe tu comentario aquí..." class="comment-textarea" required></textarea>
                <button type="submit" class="comment-submit-btn">
                    <img src="{{ asset('images/send.png') }}" alt="Enviar comentario" class="send-icon">
                </button>
            </form>
        </div>
    @else
        <div class="login-prompt">
            <p><a href="{{ route('login') }}" class="login-link">Inicia sesión</a> para agregar un comentario.</p>
        </div>
    @endauth
    </div>

@endsection
