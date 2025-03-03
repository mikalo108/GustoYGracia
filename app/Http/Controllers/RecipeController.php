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
    const PAGINATE_SIZE = 4;
    public function index()
    {
        $recipeList = Recipe::all();
        $recipeList = Recipe::paginate(self::PAGINATE_SIZE);
        return view('recipe/all', ['recipeList' => $recipeList], compact('recipeList'));
    }
    public function create()
    {
        $ingredients = Ingredient::all();
        $categories = Category::all();
        return view('recipe.create', ['ingredients' => $ingredients, 'categories' => $categories]);
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
            'prep_time' => 'required|string',
            'difficulty_level' => 'required|string',
            'ingredients' => 'required|array',
            'categories' => 'required|array',
        ]);

        $imagePath = $request->file('image')->store('recipe', 'public');
        $recipe = new Recipe();
        $recipe->name = $request->name;
        $recipe->image = $imagePath;
        $recipe->description = $request->description;
        $recipe->user_id = $request->user_id;
        $recipe->instructions = $request->instructions;
        $recipe->save();

        $recipeDetail = new RecipeDetail();
        $recipeDetail->recipe_id = $recipe->id;
        $recipeDetail->prep_time = $request->prep_time;
        $recipeDetail->difficulty_level = $request->difficulty_level;
        $recipeDetail->save();

        $recipe->ingredients()->attach($request->ingredients);
        $recipe->categories()->attach($request->categories);

        return redirect()->route('recipe.index');
    }

    public function edit($id)
    {
        $recipe = Recipe::find($id);
        $ingredients = Ingredient::all();
        $categories = Category::all();
        return view('recipe.edit', ['recipe' => $recipe, 'ingredients' => $ingredients, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {

        $recipe = Recipe::find($id);


        $recipe->name = $request->name;

        if ($request->hasFile('image')) {
            if ($recipe->image) {
                Storage::delete($recipe->image);
            }

            $imagePath = $request->file('image')->store('recipe', 'public');
            $recipe->image = $imagePath;
        }

        $recipe->description = $request->description;
        $recipe->user_id = $request->user_id;
        $recipe->instructions = $request->instructions;
        $recipe->save();

        $recipeDetail = $recipe->details;
        $recipeDetail->prep_time = $request->prep_time;
        $recipeDetail->difficulty_level = $request->difficulty_level;
        $recipeDetail->save();

        $recipe->ingredients()->sync($request->ingredients);
        $recipe->categories()->sync($request->categories);
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
