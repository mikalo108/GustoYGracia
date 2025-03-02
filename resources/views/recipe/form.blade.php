@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
    if(isset($recipe->name)){
        $title=__('admin.Edit').' '.$recipe->name;
    } else{
        $title=__('admin.Create').' '.__('admin.TitleRecipeTable');
    }
@endphp

@push('css')
    <!-- estilos adicionales -->
    <style>
        .rowSelectArray{
            display: grid;
            grid-template-columns: 1fr 0.25fr;
            column-gap: 20px;
        }
        #selectedCategories{
            row-gap: 20px;
            column-gap: 10px;
            flex-direction: row;
            justify-content: flex-start;
        }
        .btn-primary{
            margin-top: 50px;
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
                        <form 
                            style="flex-direction:column"
                            name="{{ isset($recipe) ? 'edit_recipe' : 'create_recipe' }}" 
                            action="{{ isset($recipe) ? route('recipe.update', $recipe->id) : route('recipe.store') }}" 
                            method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- Nombre de la receta -->
                            <div class="mb-3">
                                <label for="recipeName" class="form-label">{{ __('columns.recipe_1') }}</label>
                                <input id="recipeName" name="name" type="text" class="form-control" required 
                                @isset($recipe) value="{{ $recipe->name }}" @endisset />
                            </div>

                            <hr>

                            <!-- Descripción de la receta -->
                            <div class="mb-3">
                                <label for="recipeDescription" class="form-label">{{ __('columns.recipe_2') }}</label>
                                <input id="recipeDescription" name="description" type="text" class="form-control" required 
                                @isset($recipe) value="{{ $recipe->description }}" @endisset />
                            </div>

                            <hr>

                            <!-- Categorías -->
                            <div class="mb-3">
                                <label for="allCategories" class="form-label">{{ __('columns.recipe_3') }}</label>
                                <div class="rowSelectArray">
                                    <select id="allCategories" class="form-control">
                                       @foreach ($categories as $category)
                                           <option value="{{ $category->id }}">{{ $category->name }}</option>
                                       @endforeach
                                    </select>
                                    <input type="button" value="{{ __('admin.Add') }}" id="botonAddCategorias" class="btn btn-success mt-2">
                                </div>
                                <!-- Lista de categorías seleccionadas -->
                                <ul id="selectedCategories" class="nav categoriasLista mt-3">
                                    @isset($recipe->categories)
                                        @foreach ($recipe->categories as $category)
                                            <li class="categoryLi text-sm-center badge rounded-pill text-bg-success p-2" 
                                                data-id="{{ $category->id }}">
                                                {{ $category->name }}
                                                <input type="hidden" name="categories[]" value="{{ $category->id }}">
                                                <button type="button" class="btn-close remove-category ms-2"></button>
                                            </li>
                                        @endforeach
                                    @endisset
                                </ul>
                            </div>

                            <hr>

                            <!-- Ingredientes -->
                            <div class="mb-3">
                                <label for="allIngredients" class="form-label">{{ __('columns.recipe_5') }}</label>
                                <div class="rowSelectArray">
                                    <select id="allIngredients" class="form-control">
                                        @foreach ($ingredients as $ingredient)
                                            <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="button" value="{{ __('admin.Add') }}" id="botonAddIngredientes" class="btn btn-info mt-2">
                                </div>

                                <!-- Lista de ingredientes seleccionados -->
                                <ul id="selectedIngredients" class="nav ingredientesLista mt-3">
                                    @isset($recipe->ingredients)
                                        @foreach ($recipe->ingredients as $ingredient)
                                            <li class="ingredientLi text-sm-center badge rounded-pill text-bg-info p-2" 
                                                data-id="{{ $ingredient->id }}">
                                                {{ $ingredient->name }}
                                                <input type="hidden" name="ingredients[]" value="{{ $ingredient->id }}">
                                                <button type="button" class="btn-close remove-ingredient ms-2"></button>
                                            </li>
                                        @endforeach
                                    @endisset
                                </ul>
                            </div>

                            <hr>

                            <!-- Buscador de Usuario -->
                            <div class="mb-3">
                                <label for="searchUser" class="form-label">{{ __('admin.userBrowser') }}</label>
                                <input id="searchUser" type="text" class="form-control" placeholder="{{ __('admin.placeHolderSearch') }}" autocomplete="off">
                                <div id="userResults" class="list-group mt-2"></div>

                                <!-- Campo oculto para almacenar el ID del usuario seleccionado -->
                                <input type="hidden" name="user_id" id="selectedUserId" value="{{ isset($recipe) ? $recipe->user_id : '' }}">

                                <!-- Mostrar el usuario seleccionado -->
                                <p id="selectedUserName" class="mt-2">
                                    @isset($recipe)
                                        Usuario seleccionado: <strong>{{ $recipe->user->name }}</strong>
                                    @endisset
                                </p>
                            </div>



                            <!-- Botón para enviar -->
                            <input type="submit" value="{{ __('admin.save_btn') }}" class="btn btn-primary" name="saveBtn"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            // Sección Categorías e Ingredientes
                const categoriasUl = document.getElementById("selectedCategories");
                const botonAddCategorias = document.getElementById("botonAddCategorias");
                const selectCategorias = document.getElementById("allCategories");

                const ingredientesUl = document.getElementById("selectedIngredients");
                const botonAddIngredientes = document.getElementById("botonAddIngredientes");
                const selectIngredientes = document.getElementById("allIngredients");

                // Evento para agregar una categoría a la lista
                botonAddCategorias.addEventListener("click", () => {
                    const categoriaId = selectCategorias.value;
                    const categoriaTexto = selectCategorias.options[selectCategorias.selectedIndex].text;

                    // Verificar si la categoría ya existe en la lista de categorías
                    if (categoriasUl.querySelector(`li[data-id="${categoriaId}"]`)) {
                        alert("Esta categoría ya está agregada.");
                        return;
                    }

                    // Crear elemento <li> con la nueva categoría
                    const nuevaCategoriaLi = document.createElement("li");
                    nuevaCategoriaLi.className = "categoryLi text-sm-center badge rounded-pill text-bg-success p-2";
                    nuevaCategoriaLi.dataset.id = categoriaId;
                    nuevaCategoriaLi.innerHTML = `
                        ${categoriaTexto}
                        <input type="hidden" name="categories[]" value="${categoriaId}">
                        <button type="button" class="btn-close remove-category ms-2"></button>
                    `;

                    // Agregar la categoría a la lista
                    categoriasUl.appendChild(nuevaCategoriaLi);

                    // Agregar evento para eliminar la categoría
                    nuevaCategoriaLi.querySelector(".remove-category").addEventListener("click", function () {
                        this.parentElement.remove();
                    });
                });

                // Evento para eliminar una categoría existente
                document.querySelectorAll(".remove-category").forEach(btn => {
                    btn.addEventListener("click", function () {
                        this.parentElement.remove();
                    });
                });

                // Evento para agregar un ingrediente a la lista
                botonAddIngredientes.addEventListener("click", () => {
                    const ingredienteId = selectIngredientes.value;
                    const ingredienteTexto = selectIngredientes.options[selectIngredientes.selectedIndex].text;

                    // Verificar si el ingrediente ya existe en la lista de ingredientes
                    if (ingredientesUl.querySelector(`li[data-id="${ingredienteId}"]`)) {
                        alert("Este ingrediente ya está agregado.");
                        return;
                    }

                    // Crear elemento <li> con el nuevo ingrediente
                    const nuevoIngredienteLi = document.createElement("li");
                    nuevoIngredienteLi.className = "ingredientLi text-sm-center badge rounded-pill text-bg-info p-2";
                    nuevoIngredienteLi.dataset.id = ingredienteId;
                    nuevoIngredienteLi.innerHTML = `
                        ${ingredienteTexto}
                        <input type="hidden" name="ingredients[]" value="${ingredienteId}">
                        <button type="button" class="btn-close remove-ingredient ms-2"></button>
                    `;

                    // Agregar el ingrediente a la lista
                    ingredientesUl.appendChild(nuevoIngredienteLi);

                    // Agregar evento para eliminar el ingrediente
                    nuevoIngredienteLi.querySelector(".remove-ingredient").addEventListener("click", function () {
                        this.parentElement.remove();
                    });
                });

                // Evento para eliminar un ingrediente existente
                document.querySelectorAll(".remove-ingredient").forEach(btn => {
                    btn.addEventListener("click", function () {
                        this.parentElement.remove();
                    });
                });

/* ======================================================================================= */

            // Sección Usuario
            
                const searchInput = document.getElementById("searchUser");
                const resultsDiv = document.getElementById("userResults");
                const selectedUserId = document.getElementById("selectedUserId");
                const selectedUserName = document.getElementById("selectedUserName");

                // Captura la entrada del usuario en searchUser. Realiza una búsqueda cuando el usuario escribe.
                searchInput.addEventListener("input", function () {
                    const query = searchInput.value;

                    if (query.length < 2) {
                        resultsDiv.innerHTML = "";
                        return;
                    }

                    fetch(`/users/search?query=${query}`)
                        .then(response => response.json())
                        .then(users => {
                            resultsDiv.innerHTML = "";
                            users.forEach(user => {
                                const userItem = document.createElement("button");
                                userItem.className = "list-group-item list-group-item-action";
                                userItem.textContent = user.name;

                                // Al hacer clic en un usuario, guarda su ID y muestra su nombre. 
                                userItem.onclick = function () {
                                    selectedUserId.value = user.id;
                                    selectedUserName.innerHTML = `Usuario seleccionado: <strong>${user.name}</strong>`;
                                    resultsDiv.innerHTML = "";
                                    searchInput.value = "";
                                };
                                resultsDiv.appendChild(userItem);
                            });
                        });
                });

                // Oculta los resultados al hacer clic fuera del buscador.
                document.addEventListener("click", function (event) {
                    if (!searchInput.contains(event.target) && !resultsDiv.contains(event.target)) {
                        resultsDiv.innerHTML = "";
                    }
                });

/* ======================================================================================= */


        });
    </script>


@else
@endif
@endsection
