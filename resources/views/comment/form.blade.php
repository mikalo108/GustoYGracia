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
                                                    <label for="recipeSearch" class="form-label">{{__('columns.comment_2')}}</label>
                                                    <input id="recipeSearch" @isset($comment) disabled @endisset type="text" class="form-control" placeholder="{{ __('admin.placeHolderSearch') }}" autocomplete="off">
                                                    <div id="recipesSearch" class="list-group"></div>

                                                    <!-- Campo oculto para almacenar el ID del usuario seleccionado -->
                                                    <input type="hidden" name="recipe_id" id="selectedRecetaId" value="{{ isset($comment) ? $comment->recipe_id : '' }}">

                                                    <!-- Mostrar el usuario seleccionado -->
                                                    <p id="selectedRecipeName" style="margin-top:.5rem">
                                                        @isset($comment->recipe)
                                                            {{ __('admin.recipeSelected') }} <strong id="recipeNameText">{{ $comment->recipe->name }}</strong>
                                                        @endisset
                                                    </p>
                                            </div>    
                                            
                                            <!-- Buscador de Usuario -->
                                            <div class="mb-3">
                                                    <label for="userSearch" class="form-label">{{__('columns.comment_1')}}</label>
                                                    <input id="userSearch" @isset($comment) disabled @endisset type="text" class="form-control" placeholder="{{ __('admin.placeHolderSearch') }}" autocomplete="off">
                                                    <div id="usersSearch" class="list-group"></div>

                                                    <!-- Campo oculto para almacenar el ID del usuario seleccionado -->
                                                    <input type="hidden" name="user_id" id="selectedUserId" value="{{ isset($comment) ? $comment->user_id : '' }}">

                                                    <!-- Mostrar el usuario seleccionado -->
                                                    <p id="selectedUserName" style="margin-top:.5rem">
                                                        @isset($comment->user)
                                                            {{ __('admin.userSelected') }} <strong id="userNameText">{{ $comment->user->name }}</strong>
                                                        @endisset
                                                    </p>
                                            </div> 
                                            
                                            <div class="mb-3">
                                                <label for="content" class="form-label">{{__('columns.comment_3')}}</label>
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

                // Recipe
                    const recipeInput = document.getElementById("recipeSearch");
                    const resultsDivRecipe = document.getElementById("recipesSearch");
                    const selectedRecetaId = document.getElementById("selectedRecetaId");
                    const selectedRecipeName = document.getElementById("selectedRecipeName");

                    recipeInput.addEventListener("input", function () {
                        const query = recipeInput.value;

                        if (query.length < 2) {
                            resultsDivRecipe.innerHTML = "";
                            return;
                        }

                        fetch(`/searchRecipes?query=${encodeURIComponent(query)}`)
                            .then(response => response.json())
                            .then(recipes => {
                                resultsDivRecipe.innerHTML = "";
                                recipes.forEach(recipe => {
                                    const recipeItem = document.createElement("button");
                                    recipeItem.className = "list-group-item list-group-item-action";
                                    recipeItem.textContent = recipe.name;
                                    
                                    recipeItem.onclick = function () {
                                        selectedRecetaId.value = recipe.id;
                                        selectedRecipeName.innerHTML = `{{ __('admin.recipeSelected') }} <strong id="recipeNameText">${recipe.name}</strong> 
                                            <button type="button" id="clearRecipe" class="btn btn-danger btn-sm ms-2">X</button>`;
                                            resultsDivRecipe.innerHTML = "";
                                        recipeInput.value = "";

                                        document.getElementById("clearRecipe").addEventListener("click", function () {
                                            selectedRecetaId.value = "";
                                            selectedRecipeName.innerHTML = "";
                                        });
                                    };
                                    resultsDivRecipe.appendChild(recipeItem);
                                });
                            });
                    });

                    document.addEventListener("click", function (event) {
                        if (!recipeInput.contains(event.target) && !resultsDivRecipe.contains(event.target)) {
                            resultsDivRecipe.innerHTML = "";
                        }
                    });
                /*================================================================*/

                // User
                    const userInput = document.getElementById("userSearch");
                    const resultsDivUser = document.getElementById("usersSearch");
                    const selectedUserId = document.getElementById("selectedUserId");
                    const selectedUserName = document.getElementById("selectedUserName");

                    userInput.addEventListener("input", function () {
                        const query = userInput.value;

                        if (query.length < 2) {
                            resultsDivUser.innerHTML = "";
                            return;
                        }

                        fetch(`/searchUsers?query=${encodeURIComponent(query)}`)
                            .then(response => response.json())
                            .then(users => {
                                resultsDivUser.innerHTML = "";
                                users.forEach(user => {
                                    const userItem = document.createElement("button");
                                    userItem.className = "list-group-item list-group-item-action";
                                    userItem.textContent = user.name;
                                    
                                    userItem.onclick = function () {
                                        selectedUserId.value = user.id;
                                        selectedUserName.innerHTML = `{{ __('admin.userSelected') }} <strong id="userNameText">${user.name}</strong> 
                                            <button type="button" id="clearUser" class="btn btn-danger btn-sm ms-2">X</button>`;
                                            resultsDivUser.innerHTML = "";
                                            userInput.value = "";

                                        document.getElementById("clearUser").addEventListener("click", function () {
                                            selectedUserId.value = "";
                                            selectedUserName.innerHTML = "";
                                        });
                                    };
                                    resultsDivUser.appendChild(userItem);
                                });
                            });
                    });

                    document.addEventListener("click", function (event) {
                        if (!userInput.contains(event.target) && !resultsDivUser.contains(event.target)) {
                            resultsDivUser.innerHTML = "";
                        }
                    });


            });
        </script>
    @else

    @endif

    @endsection
