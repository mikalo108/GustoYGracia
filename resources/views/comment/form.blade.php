@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
    if(isset($comment->name)){
        $title=__('admin.Edit').' '.$comment->name;
    } else{
        $title=__('admin.Create').' '.__('admin.TitleCommentTable');
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
                            @isset($comment)
                                <form name="edit_comment" action="{{ route('comment.update', $comment->id) }}" method="post">
                                @csrf
                            @else
                                <form name="create_comment" action="{{ route('comment.store') }}" method="post">
                                @csrf
                            @endisset
                                <div class="mb-3">
                                    <h6 class="form-label" style="margin-bottom:7px;"> ({{ __('admin.optionalFields') }})</h6>
                                    <div class="card" style="padding-inline: 20px; padding-block: 2px; margin-bottom: 30px;">
                                        <div class="card-body">
                                            
                                            <!-- Buscador de Receta -->
                                            <div class="mb-3">
                                                    <label for="recipeSearch" class="form-label">{{__('admin.TitleCommentTable')}} {{__('columns.comment_2')}}</label>
                                                    <input id="recipeSearch" @isset($comment) disabled @endisset type="text" class="form-control" placeholder="{{ __('admin.placeHolderSearch') }}" autocomplete="off">
                                                    <div id="recipesSearch" class="list-group mt-2"></div>

                                                    <!-- Campo oculto para almacenar el ID del usuario seleccionado -->
                                                    <input type="hidden" name="recipe_id" id="selectedRecetaId" value="{{ isset($comment) ? $comment->recipe_id : '' }}">

                                                    <!-- Mostrar el usuario seleccionado -->
                                                    <p id="selectedRecipeName" class="mt-2">
                                                        @isset($comment->recipe)
                                                            {{ __('admin.recipeSelected') }} <strong id="recipeNameText">{{ $comment->recipe->name }}</strong>
                                                        @endisset
                                                    </p>
                                            </div>        
                                            
                                            <div class="mb-3">
                                                <label for="user" class="form-label">{{__('admin.TitleCommentTable')}} {{__('columns.comment_1')}}</label>
                                                <input id="user"  @isset($comment) disabled @endisset type="text"
                                                class="form-control" @isset($comment) value="{{$comment->user->name}}" @endisset />
                                            </div>
                                            <div class="mb-3">
                                                <label for="content" class="form-label">{{__('admin.TitleCommentTable')}} {{__('columns.comment_3')}}</label>
                                                <textarea id="content" required name="content" 
                                                class="form-control">@isset($comment){{$comment->content}}@endisset</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" value="{{__('admin.save_btn')}}" class="btn btn-primary" name="saveBtn"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const searchInput = document.getElementById("recipeSearch");
                const resultsDiv = document.getElementById("recipesSearch");
                const selectedRecetaId = document.getElementById("selectedRecetaId");
                const selectedRecipeName = document.getElementById("selectedRecipeName");

                searchInput.addEventListener("input", function () {
                    const query = searchInput.value;

                    if (query.length < 2) {
                        resultsDiv.innerHTML = "";
                        return;
                    }

                    fetch(`/recipe/search?query=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(recipes => {
                            resultsDiv.innerHTML = "";
                            recipes.forEach(recipe => {
                                const recipeItem = document.createElement("button");
                                recipeItem.className = "list-group-item list-group-item-action";
                                recipeItem.textContent = recipe.name;
                                
                                recipeItem.onclick = function () {
                                    selectedRecetaId.value = recipe.id;
                                    selectedRecipeName.innerHTML = `{{ __('admin.recipeSelected') }} <strong id="recipeNameText">${recipe.name}</strong> 
                                        <button type="button" id="clearRecipe" class="btn btn-danger btn-sm ms-2">X</button>`;
                                    resultsDiv.innerHTML = "";
                                    searchInput.value = "";

                                    document.getElementById("clearRecipe").addEventListener("click", function () {
                                        selectedRecetaId.value = "";
                                        selectedRecipeName.innerHTML = "";
                                    });
                                };
                                resultsDiv.appendChild(recipeItem);
                            });
                        });
                });

                document.addEventListener("click", function (event) {
                    if (!searchInput.contains(event.target) && !resultsDiv.contains(event.target)) {
                        resultsDiv.innerHTML = "";
                    }
                });
            });
        </script>
    @else

    @endif

    @endsection
