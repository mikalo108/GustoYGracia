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
    @if (Auth::check() && Auth::user()->id === $recipe->user_id)
        <div class='delete-recipe-container'> 
            <form action="{{ route('recipe.removeRecipe', ['recipe' => $recipe->id, 'user' => Auth::user()->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" id="cancel-btn">{{ __('messages.Delete') }}</button>
            </form>
        </div>
    @endif
    <div id="body-recipe">
        <div id="recipe-container">
            <h1 class="recipe-title">{{ $recipe->name }}</h1>
            <p class="recipe-user">{{ __('messages.PostBy') }}: <a class="user-link"
                    href="{{ route('user.show', $recipe->user->id) }}">
                    {{ $recipe->user->name }}
                </a></p>

            <div class="recipe-image-container">
                <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->name }}" class="recipe-image">
            </div>

            <div class="recipe-description">
                <br>
                <p>{{ $recipe->description }}</p>
            </div>

            <div class="recipe-details">
                <div class="detail-item">
                    <p><span style="color: #16404D">{{ __('messages.PrepTime') }}:
                        </span>{{ $recipe->details->prep_time }}
                    </p>
                </div>

                <div class="detail-item">
                    <p><span style="color: #16404D">{{ __('messages.Difficulty') }}:
                        </span>{{ $recipe->details->difficulty_level }}</p>
                </div>
            </div>

            <div class="recipe-ingredients">
                <h4>{{ __('messages.Ingredients') }}:</h4>
                <ul>
                    @foreach ($ingredients as $ingredient)
                        @if ($recipe->ingredients->contains($ingredient->id))
                            <li>{{ $ingredient->name }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div class="recipe-ingredients">
                <h4>{{ __('messages.Instructions') }}:</h4>
                <p>{{ $recipe->instructions }}</p>
            </div>
            <br>
            <p>TAG:
                @foreach ($categories as $category)
                    @if ($recipe->categories->contains($category->id))
                        <span>{{ $category->name }} </span>
                    @endif
                @endforeach
            </p>
        </div>
    </div>

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
