<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeDetail;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    // Constante que define el número de elementos al mostrar en la página de inicio
    private const PAGINATE_SIZE = 4;

    // Función que devuelve a la página de inicio con los elementos que debe mostrar filtrados. Si la query está vacía, devuelve todos los elementos.
    public function index(Request $request) {
        $query = Recipe::query();
    
        // Filtrar por nombre de la receta
        if ($request->filled('recipeName')) {
            $query->where('name', 'like', '%' . $request->recipeName . '%');
        }
    
        // Filtrar por descripción de la receta
        if ($request->filled('recipeDescription')) {
            $query->where('description', 'like', '%' . $request->recipeDescription . '%');
        }
    
        // Filtrar por categoría (relación belongsToMany)
        if ($request->filled('recipeCategory')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->recipeCategory . '%');
            });
        }
    
        // Filtrar por usuario (relación belongsTo)
        if ($request->filled('recipeUser')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->recipeUser . '%');
            });
        }
    
        // Obtener las recetas paginadas y ordenadas por ID descendente
        $recipeList = $query->orderBy('id', 'desc')->paginate(self::PAGINATE_SIZE);
    
        // Retornar la vista con los filtros aplicados
        return view('recipe/all', compact('recipeList'))
            ->with([
                'recipeName' => $request->recipeName,
                'recipeDescription' => $request->recipeDescription,
                'recipeCategory' => $request->recipeCategory,
                'recipeUser' => $request->recipeUser
            ]);
    }
    
    //  Función para devolver a la página de creación del elemento
    public function create()
    {
        $ingredients = Ingredient::all();
        $categories = Category::all();
        return view('recipe/form', ['ingredients' => $ingredients, 'categories' => $categories]);
    }

    //  Función para devolver a la página de creación del elemento por el usuario
    public function userCreate()
    {
        $ingredients = Ingredient::all();
        $categories = Category::all();
        return view('recipe.userForm', ['ingredients' => $ingredients, 'categories' => $categories]);
    }

    // Función para buscar usuario
    public function userSearch(Request $request)
    {
        $query = $request->input('query');

        $recipes = Recipe::where('name', 'LIKE', "%$query%")
            ->orWhereHas('ingredients', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%$query%");
            })
            ->get();

        return view('recipe.searchResults', ['recipes' => $recipes, 'query' => $query]);
    }

    //  Función para devolver a la página de detalles del elemento que se pide
    public function show($id)
    {
        $recipe = Recipe::with('ingredients')->findOrFail($id);
        $ingredients = Ingredient::all();
        $categories = Category::all();
        $comments = Comment::all();
        return view('recipe.show', ['recipe' => $recipe, 'ingredients' => $ingredients, 'categories' => $categories, 'comments' => $comments]);
    }

    //  Función para devolver a la página de recetas creadas por el usuario
    public function showMyRecipes($userId)
    {
        $user = User::find($userId);
        $recipeList = $user->recipes()->get();

        return view('myRecipes', compact('recipeList'));
    }

    //  Función para filtrar recetas por categoría
    public function showByCategory($categoryId)
    {
        $category = Category::find($categoryId);
        $recipesByCategory = $category->recipes()->get();
        return view('recipe.searchResults', ['category' => $category, 'recipesByCategory' => $recipesByCategory]);
    }

    //  Función para guardar el elemento en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string|max:1000',
            'user_id' => 'required|exists:users,id',
            'instructions' => 'required|string|max:1000',
            'prep_time' => 'required|integer',
            'difficulty_level' => 'required|string|max:50',
            'ingredients' => 'required|array',
            'ingredients.*' => 'exists:ingredients,id',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('recipes', 'public');
        } else {
            // Manejar el caso en que la imagen no es válida o no se sube
            return back()->withErrors(['image' => 'La imagen no es válida.']);
        }
        
        

        $image='recipes/' . basename($imagePath);

        $recipe = new Recipe();
        $recipe->name = $request->input('name');
        $recipe->image = $image;
        $recipe->description = $request->input('description');
        $recipe->user_id = $request->input('user_id');
        $recipe->instructions = $request->input('instructions');
        $recipe->save();

        $recipeDetail = new RecipeDetail();
        $recipeDetail->prep_time = $request->input('prep_time');
        $recipeDetail->difficulty_level = $request->input('difficulty_level');
        $recipeDetail->recipe_id = $recipe->id;
        $recipeDetail->save();
        


        $recipe->categories()->sync($request->categories);
        $ingredientsWithQuantities = [];
        foreach ($request->ingredients as $ingredientId) {
            $ingredientsWithQuantities[$ingredientId] = ['quantity' => $request->quantities[$ingredientId] ?? 1];
        }
        $recipe->ingredients()->sync($ingredientsWithQuantities);

        return redirect()->route('recipe.index');
    }

    //  Función para guardar el elemento en la base de datos por el usuario
    public function userStore(Request $request, $user_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'instructions' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'prep_time' => 'required|integer|min:1',
            'difficulty_level' => 'required|string|in:baja,media,alta',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string|max:255',
            'ingredients.*.quantity' => 'required|string|max:100',
        ]);

        $imagePath = 'recipes/default.png'; // Ruta por defecto

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Prefijo para evitar colisiones
            $imagePath = $image->storeAs('recipes', $imageName, 'public'); // Guarda la imagen con su nombre original
        }
        
        $recipe = Recipe::create([
            'name' => $request->name,
            'description' => $request->description,
            'instructions' => $request->instructions,
            'image' => $imagePath ?? 'default.png',
            'user_id' => $user_id,
        ]);

        $recipe->categories()->sync($request->category_id);

        $recipe->details()->create([
            'prep_time' => $request->prep_time,
            'difficulty_level' => $request->difficulty_level,
        ]);
        

        foreach ($request->ingredients as $ingredientData) {
            // Buscar si el ingrediente ya existe
            $ingredient = Ingredient::firstOrCreate(
                ['name' => $ingredientData['name']]
            );
    
            // Asignar la relación en recipe_ingredients
            $recipe->ingredients()->attach($ingredient->id, [
                'quantity' => $ingredientData['quantity']
            ]);
        }

        return redirect()->route('myRecipes', $user_id);
    }

    //  Función para devolver a la página de edición del elemento
    public function edit($id)
    {
        $recipe = Recipe::find($id);
        $ingredients = Ingredient::all();
        $categories = Category::all();
        return view('recipe/form', ['recipe' => $recipe, 'ingredients' => $ingredients, 'categories' => $categories]);
    }

    //  Función para actualizar el elemento en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string|max:1000',
            'user_id' => 'required|exists:users,id',
            'instructions' => 'required|string|max:1000',
            'prep_time' => 'required|integer',
            'difficulty_level' => 'required|string|max:50',
            'ingredients' => 'nullable|array',
            'ingredients.*' => 'exists:ingredients,id',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
        ]);

        $recipe = Recipe::findOrFail($id);
        $recipe->update([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'instructions' => $request->instructions,
        ]);

        if ($request->hasFile('image')) {
            if ($recipe->image) {
                Storage::delete('public/' . $recipe->image);
            }
            $imagePath = $request->file('image')->store('recipes', 'public');
            $recipe->image = 'recipes/' . basename($imagePath);
            $recipe->save();
        }

        $recipeDetail = $recipe->details ?? new RecipeDetail();
        $recipeDetail->recipe_id = $recipe->id;
        $recipeDetail->prep_time = $request->prep_time;
        $recipeDetail->difficulty_level = $request->difficulty_level;
        $recipeDetail->save();

        $recipe->categories()->sync($request->categories ?? []);
        $ingredientsWithQuantities = [];
        if ($request->ingredients) {
            foreach ($request->ingredients as $ingredientId) {
                $ingredientsWithQuantities[$ingredientId] = ['quantity' => $request->quantities[$ingredientId] ?? 1];
            }
        }
        $recipe->ingredients()->sync($ingredientsWithQuantities);

        return redirect()->route('recipe.index');
    }

    //  Funcion para eliminar el elemento de la base de datos
    public function destroy($id)
    {
        $recipe = Recipe::find($id);
        $recipe->delete();
        return redirect()->route('recipe.index');
    }

    //  Funcion para eliminar el elemento de la base de datos por el usuario
    public function removeRecipe($recipeId, $userId)
    {
        $recipe = Recipe::find($recipeId);
        $recipe->delete();
        return redirect()->route('myRecipes', $userId);
    }
}
