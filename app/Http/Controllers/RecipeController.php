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
    private const PAGINATE_SIZE = 4;
    public function index(){
        $recipeList = Recipe::paginate(self::PAGINATE_SIZE);
        return view('recipe/all', ['recipeList' => $recipeList], compact('recipeList'));
    }
    public function create()
    {
        $ingredients = Ingredient::all();
        $categories = Category::all();
        return view('recipe/form', ['ingredients' => $ingredients, 'categories' => $categories]);
    }

    public function show($id)
    {
        $recipe = Recipe::find($id);
        $ingredients = Ingredient::all();
        $categories = Category::all();
        $comments = Comment::all();
        return view('recipe.show', ['recipe' => $recipe, 'ingredients' => $ingredients, 'categories' => $categories, 'comments' => $comments]);
    }

    public function showMyRecipes($userId)
    {
        $user = User::find($userId);
        $recipeList = $user->recipes()->get();

        return view('myRecipes', compact('recipeList'));
    }

    public function showByCategory($categoryId)
    {
        $category = Category::find($categoryId);
        $recipesByCategory = $category->recipes()->get(); 
        return view('recipe.showByCategory', ['category' => $category, 'recipesByCategory' => $recipesByCategory]);
    }

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

        $imagePath = $request->file('image')->store('recipes', 'public');

        $recipe = Recipe::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => 'recipes/' . basename($imagePath),
            'user_id' => $request->user_id,
            'instructions' => $request->instructions,
        ]);

        RecipeDetail::create([
            'recipe_id' => $recipe->id,
            'prep_time' => $request->prep_time,
            'difficulty_level' => $request->difficulty_level,
        ]);

        $recipe->categories()->sync($request->categories);
        $ingredientsWithQuantities = [];
        foreach ($request->ingredients as $ingredientId) {
            $ingredientsWithQuantities[$ingredientId] = ['quantity' => $request->quantities[$ingredientId] ?? 1];
        }
        $recipe->ingredients()->sync($ingredientsWithQuantities);

        return redirect()->route('recipe.index');
    }

    public function edit($id)
    {
        $recipe = Recipe::find($id);
        $ingredients = Ingredient::all();
        $categories = Category::all();
        return view('recipe/form', ['recipe' => $recipe, 'ingredients' => $ingredients, 'categories' => $categories]);
    }

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

    public function destroy($id)
    {
        $recipe = Recipe::find($id);
        $recipe->delete();
        return redirect()->route('recipe.index');
    }

    public function removeRecipe($recipeId, $userId)
    {
        $recipe = Recipe::find($recipeId);
        $recipe->delete();
        return redirect()->route('myrecipes', $userId);
    }
}
