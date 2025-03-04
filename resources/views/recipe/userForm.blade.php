@extends('layouts.app')

@push('css')
    <style>
        #create-recipe-form {
            display: block;
        }

        /* Estilos para el formulario de crear receta */
        #recipe-container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 1.1rem;
            color: #16404D;
            margin-bottom: 10px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border: 1px solid #A6CDC6;
            border-radius: 8px;
            color: #333;
        }

        .form-control:focus {
            border-color: #DDA853;
            outline: none;
        }

        textarea.form-control {
            resize: vertical;
        }

        .btn-submit {
            background-color: #DDA853;
            color: white;
            font-size: 1.2rem;
            padding: 12px 20px;
            border-radius: 50px;
            cursor: pointer;
            width: 100%;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #16404D;
            transform: scale(1.05);
        }
    </style>
@endpush

@section('content')
    <div class="recipe-container">
        <h1>{{ __('Crear nueva receta') }}</h1>

        <form id="create-recipe-form" action="{{ route('recipe.userStore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nombre de la receta</label>
                <input type="text" id="name" name="name" class="form-control"
                    placeholder="Ingresa el nombre de la receta" required>
            </div>

            <div class="form-group">
                <label for="category_id">Categoría</label>
                <select id="category_id" name="category_id" class="form-control" required>
                    <option value="" disabled selected>Selecciona una categoría</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea id="description" name="description" class="form-control" rows="5"
                    placeholder="Describe los pasos para hacer esta receta" required></textarea>
            </div>

            <div class="form-group">
                <label for="image">Imagen</label>
                <input type="file" id="image" name="image" class="form-control-file" accept="image/*">
            </div>

            <div class="form-group">
                <label for="instructions">Instrucciones</label>
                <textarea id="instructions" name="instructions" class="form-control" rows="5"
                    placeholder="Explica cómo preparar la receta paso a paso" required></textarea>
            </div>

            <div class="form-group">
                <label for="difficulty">Dificultad</label>
                <select id="difficulty" name="difficulty" class="form-control" required>
                    <option value="fácil">Bajo</option>
                    <option value="intermedio">Medio</option>
                    <option value="difícil">Alto</option>
                </select>
            </div>

            <div class="form-group">
                <label for="prep_time">Tiempo de preparación (en minutos)</label>
                <input type="number" id="prep_time" name="prep_time" class="form-control"
                    placeholder="Tiempo de preparación" required>
            </div>

            <!-- Ingredientes -->
            <div class="form-group">
                <h3>{{ __('Ingredientes') }}</h3>
                <div id="ingredients-section">
                    <div class="ingredient-item">
                        <input type="text" name="ingredients[0][ingredient]" class="form-control"
                            placeholder="Ingrediente" required>
                        <input type="number" name="ingredients[0][quantity]" class="form-control" placeholder="Cantidad"
                            required>
                    </div>
                </div>
                <button type="button" id="add-ingredient" id="login-btn">Añadir otro ingrediente</button>
            </div>
            <div class="form-group">




                <div class="form-group">
                    <button type="submit" class="btn btn-submit">Crear Receta</button>
                </div>
        </form>


    </div>

    <script>
        document.getElementById('add-ingredient').addEventListener('click', function() {
            let ingredientSection = document.getElementById('ingredients-section');
            let index = ingredientSection.querySelectorAll('.ingredient-row').length;
            let newRow = `
            <div class="ingredient-row">
                <select name="ingredients[${index}][ingredient_id]" class="form-control" required>
                    <option value="">Selecciona un ingrediente</option>
                    @foreach ($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                    @endforeach
                </select>
                <input type="text" name="ingredients[${index}][quantity]" class="form-control" placeholder="Cantidad" required>
            </div>
        `;
            ingredientSection.innerHTML += newRow;
        });
    </script>
@endsection
