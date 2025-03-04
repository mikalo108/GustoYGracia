@extends('layouts.app')

@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
@endphp

@section('title', __('messages.CreateRecipe') . ' | Gusto&Gracia')

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
        <h1>{{ __('messages.CreateNewRecipe') }}</h1>
        <br><br>
        <form id="create-recipe-form" action="{{ route('recipe.userStore', Auth::user()->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="create-recipe-form-group">
                <label for="name">{{ __('messages.Name') }}</label>
                <input type="text" id="name" name="name" class="create-recipe-form-control" required>
            </div>

            <div class="create-recipe-form-group">
                <label for="category_id">{{ __('messages.Category') }}</label>
                <select id="category_id" name="category_id" class="create-recipe-form-control" required>
                    <option value="" disabled selected></option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="create-recipe-form-group">
                <label for="description">{{ __('messages.Description') }}</label>
                <textarea id="description" name="description" class="create-recipe-form-control" rows="5" required></textarea>
            </div>

            <div class="create-recipe-form-group">
                <label for="image">{{ __('messages.Image') }}</label>
                <div class="custom-file-upload">
                    <input type="file" id="image" name="image" class="form-control-file" accept="image/*"
                        style="display: none;">
                    <button type="button" id="custom-button">{{ __('messages.ChooseFile') }}</button>
                    <span id="custom-text">{{ __('messages.NoFileChosen') }}</span>
                </div>
            </div>

            <div class="create-recipe-form-group">
                <label for="instructions">{{ __('messages.Instructions') }}</label>
                <textarea id="instructions" name="instructions" class="create-recipe-form-control" rows="5" required></textarea>
            </div>

            <div class="create-recipe-form-group">
                <label for="difficulty_level">{{ __('messages.Difficulty') }}</label>
                <select id="difficulty_level" name="difficulty_level" class="create-recipe-form-control" required>
                    <option value="baja">{{ __('messages.Low') }}</option>
                    <option value="media">{{ __('messages.Medium') }}</option>
                    <option value="alta">{{ __('messages.High') }}</option>
                </select>
            </div>

            <div class="create-recipe-form-group">
                <label for="prep_time">{{ __('messages.PrepTime') }}</label>
                <input type="number" id="prep_time" name="prep_time" class="create-recipe-form-control" required>
            </div>

            <!-- Ingredientes -->
            <div class="create-recipe-form-group" id="ingredients-container">
                <label>{{ __('messages.Ingredients') }}</label>
                <button type="button" id="add-ingredient">➕ {{ __('messages.Add') }}</button>
                <div class="ingredient-row">
                    <input type="text" name="ingredients[0][name]" class="ingredients-form-control"
                        placeholder={{ __('messages.Name') }} required>
                    <input type="text" name="ingredients[0][quantity]" class="ingredients-form-control"
                        placeholder={{ __('messages.Quantity') }} required>
                </div>
            </div>

            <div class="create-recipe-form-group">
                <button type="submit" id="edit-btn">{{ __('messages.CreateRecipe') }}</button>
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
