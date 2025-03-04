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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
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
        #removeImage{
            position: relative;
            top: -20px;
        }
        .imgSection{
            display: flex;
            flex-direction: column;
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
                            action="{{ isset($recipe) ? route('recipe.update', $recipe->id) : route('recipe.store') }}" 
                            method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- Imagen de la receta -->
                            <div class="mb-3">
                                <label for="recipeImage" class="form-label">{{ __('columns.recipe_6') }}</label>
                                <div class="imgSection">
                                    <!-- Mostrar la imagen si ya existe -->
                                    @isset($recipe->image)
                                        <div id="imagePreviewContainer" class="mt-3">
                                            <img id="imagePreview" src="{{ asset('storage/' . $recipe->image) }}" class="img-fluid rounded" style="max-width: 300px;">
                                        </div>
                                    @endisset

                                    <input type="file" class="form-control" id="recipeImage" name="image" accept="image/*">
                                    
                                    <!-- Campo oculto para marcar eliminación (ya no se usará) -->
                                    <input type="hidden" name="remove_image" id="removeImageInput" value="0">
                                </div>
                            </div>

                            <hr>

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
                                    <select id="allCategories" class="form-control" data-url="{{ route('categories.search') }}">
                                       @foreach ($categories as $category)
                                           <option value="{{ $category->id }}">{{ $category->name }}</option>
                                       @endforeach
                                    </select>
                                    <input type="button" value="{{ __('admin.Add') }}" id="botonAddCategorias" class="btn btn-success">
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
                                    <select id="allIngredients" class="form-control" data-url="{{ route('ingredients.search') }}">
                                        @foreach ($ingredients as $ingredient)
                                            <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="button" value="{{ __('admin.Add') }}" id="botonAddIngredientes" class="btn btn-info">
                                </div>

                                <!-- Lista de ingredientes seleccionados -->
                                <ul id="selectedIngredients" class="nav ingredientesLista mt-3">
                                    @isset($recipe->ingredients)
                                        @foreach ($recipe->ingredients as $ingredient)
                                            <li class="ingredientLi text-sm-center badge rounded-pill text-bg-info p-2" 
                                                data-id="{{ $ingredient->id }}">
                                                {{ $ingredient->name }}
                                                <input type="hidden" name="ingredients[]" value="{{ $ingredient->id }}">
                                                <input type="number" name="quantities[{{ $ingredient->id }}]" 
                                                    value="{{ $ingredient->pivot->quantity ?? 1 }}" 
                                                    min="1" class="form-control d-inline w-25 ms-2">
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
                                <p id="selectedUserName" style="margin-top: 10px;">
                                    @isset($recipe)
                                        {{ __('admin.userSelected') }} <strong id="userNameText">{{ $recipe->user->name }}</strong>
                                        <button type="button" id="clearUser" class="btn btn-danger btn-sm ms-2">X</button>
                                    @endisset
                                </p>
                            </div>

                            <!-- Detalles de la receta -->
                            <div class="mb-3">
                                <h6 class="form-label" style="margin-bottom:7px;">{{ __('admin.recipeDetail_title') }}</h6>
                                <div class="card" style="padding-inline: 20px; padding-block: 2px; margin-bottom: 30px;">
                                    <div class="card-body">
                                        <label for="prep_time" class="form-label">{{ __('admin.recipeDetail_1') }}  ( ´ )</label>
                                        <input id="prep_time" name="prep_time" type="text" class="form-control" required 
                                        @isset($recipe->details->prep_time) value="{{ $recipe->details->prep_time }}" @endisset />

                                        <label for="difficulty_level" class="form-label">{{ __('admin.recipeDetail_2') }}</label>
                                        <input id="difficulty_level" name="difficulty_level" type="text" class="form-control" required 
                                        @isset($recipe->details->prep_time) value="{{ $recipe->details->difficulty_level }}" @endisset />
                                    </div>
                                </div>
                            </div>

                            <!-- Instrucciones -->
                            <div class="mb-3">
                                <label for="instructions" class="form-label">{{ __('admin.recipeInstructions') }}</label>
                                <textarea id="instructions" rows="10" name="instructions" class="form-control" 
                                required>@isset($recipe->instructions){{$recipe->instructions}}@endisset
                                </textarea>
                            </div>


                            <!-- Botón para enviar -->
                            <input type="submit" value="{{ __('admin.save_btn') }}" class="btn btn-primary"/>
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
                        <input type="number" name="quantities[${ingredienteId}]" value="1" min="1" class="form-control d-inline w-25 ms-2">
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
                const userInput = document.querySelector("#searchUser");
                const resultsDiv = document.getElementById("userResults");
                const selectedUserId = document.getElementById("selectedUserId");
                const selectedUserName = document.getElementById("selectedUserName");
                const clearUserBtn = document.getElementById("clearUser");

                // Captura la entrada del usuario en searchUser. Realiza una búsqueda cuando el usuario escribe.
                userInput.addEventListener("input", function () {
                    const query = userInput.value;

                    if (query.length < 2) {
                        resultsDiv.innerHTML = "";
                        return;
                    }

                    fetch(`/searchUsers?query=${query}`)
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
                                    selectedUserName.innerHTML = `{{ __('admin.userSelected') }} <strong id="userNameText">${user.name}</strong>
                                        <button type="button" id="clearUser" class="btn btn-danger btn-sm ms-2">X</button>`;
                                    resultsDiv.innerHTML = "";
                                    userInput.value = "";  // Limpiar el campo de búsqueda

                                    // Mover la lógica del "clearUser" aquí para evitar múltiples escuchadores
                                    document.getElementById("clearUser").addEventListener("click", function () {
                                        selectedUserId.value = "";
                                        selectedUserName.innerHTML = "";
                                    });
                                };
                                resultsDiv.appendChild(userItem);
                            });
                        });
                });

                // Oculta los resultados al hacer clic fuera del buscador.
                document.addEventListener("click", function (event) {
                    if (!userInput.contains(event.target) && !resultsDiv.contains(event.target)) {
                        resultsDiv.innerHTML = "";
                    }
                });

                // Evento para limpiar la selección de usuario
                if (clearUserBtn) {
                    clearUserBtn.addEventListener("click", function () {
                        selectedUserId.value = "";
                        selectedUserName.innerHTML = "";
                    });
                }


/* ======================================================================================= */

        // Sección imagen
            const imageInput = document.getElementById("recipeImage");
            const imagePreviewContainer = document.getElementById("imagePreviewContainer");

            // Si ya existe una imagen, mostrarla
            @isset($recipe->image)
                const imagePreview = document.getElementById("imagePreview");
                imagePreviewContainer.style.display = "block";  // Asegurar que la imagen está visible
            @endisset

            // Mostrar la previsualización de la imagen seleccionada
            imageInput.addEventListener("change", function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        // Si no hay previsualización, crearla
                        if (!imagePreviewContainer) {
                            const previewContainer = document.createElement("div");
                            previewContainer.id = "imagePreviewContainer";
                            previewContainer.classList.add("mt-3");
                            previewContainer.innerHTML = `
                                <img id="imagePreview" class="img-fluid rounded" style="max-width: 300px;">
                            `;
                            imageInput.parentNode.appendChild(previewContainer);
                        }

                        // Mostrar la nueva imagen seleccionada
                        const imagePreview = document.getElementById("imagePreview");
                        imagePreview.src = e.target.result; // Asignar la nueva imagen
                        imagePreviewContainer.style.display = "block"; // Asegurar que la imagen está visible
                    };
                    reader.readAsDataURL(file); // Leer la imagen seleccionada
                }
            });


        });
    </script>
   
@else
@endif
@endsection
