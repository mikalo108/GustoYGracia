@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="create-recipe-container">
        <br>
        <h1>{{ __('Crear nueva receta') }}</h1>
        <br><br>
        <form id="create-recipe-form" action="{{ route('recipe.userStore', Auth::user()->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="create-recipe-form-group">
                <label for="name">Nombre de la receta</label>
                <input type="text" id="name" name="name" class="create-recipe-form-control"
                    placeholder="Ingresa el nombre de la receta" required>
            </div>

            <div class="create-recipe-form-group">
                <label for="category_id">Categoría</label>
                <select id="category_id" name="category_id" class="create-recipe-form-control" required>
                    <option value="" disabled selected>Selecciona una categoría</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="create-recipe-form-group">
                <label for="description">Descripción</label>
                <textarea id="description" name="description" class="create-recipe-form-control" rows="5"
                    placeholder="Describe los pasos para hacer esta receta" required></textarea>
            </div>

            <div class="create-recipe-form-group">
                <label for="image">Imagen</label>
                <input type="file" id="image" name="image" class="form-control-file" accept="image/*">
            </div>

            <div class="create-recipe-form-group">
                <label for="instructions">Instrucciones</label>
                <textarea id="instructions" name="instructions" class="create-recipe-form-control" rows="5"
                    placeholder="Explica cómo preparar la receta paso a paso" required></textarea>
            </div>

            <div class="create-recipe-form-group">
                <label for="difficulty_level">Dificultad</label>
                <select id="difficulty_level" name="difficulty_level" class="create-recipe-form-control" required>
                    <option value="baja">Baja</option>
                    <option value="media">Media</option>
                    <option value="alta">Alta</option>
                </select>
            </div>

            <div class="create-recipe-form-group">
                <label for="prep_time">Tiempo de preparación (en minutos)</label>
                <input type="number" id="prep_time" name="prep_time" class="create-recipe-form-control"
                    placeholder="Tiempo de preparación" required>
            </div>

            <!-- Ingredientes -->
            <div class="create-recipe-form-group" id="ingredients-container">
                <label>Ingredientes</label>
                <button type="button" id="add-ingredient">➕ Añadir</button>
                <div class="ingredient-row">
                    <input type="text" name="ingredients[0][name]" class="ingredients-form-control"
                        placeholder="Nombre del ingrediente" required>
                    <input type="text" name="ingredients[0][quantity]" class="ingredients-form-control"
                        placeholder="Cantidad" required>
                </div>
            </div>

            <div class="create-recipe-form-group">
                <button type="submit" id="edit-btn">Crear Receta</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        let ingredientIndex = 1;

        document.getElementById('add-ingredient').addEventListener('click', function() {
            const container = document.getElementById('ingredients-container');
            const div = document.createElement('div');
            div.classList.add('ingredient-row');
            div.innerHTML = `
            <br>
    <input type="text" name="ingredients[${ingredientIndex}][name]" class="ingredients-form-control" placeholder="Nombre del ingrediente" required>
    <input type="text" name="ingredients[${ingredientIndex}][quantity]" class="ingredients-form-control" placeholder="Cantidad" required>
    <button type="button" class="remove-ingredient">❌</button>
`;
            container.appendChild(div);
            ingredientIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-ingredient')) {
                e.target.parentElement.remove();
            }
        });
    </script>
@endpush
