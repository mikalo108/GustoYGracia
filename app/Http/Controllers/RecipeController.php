<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\RecipeDetail;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    const PAGINATE_SIZE = 4;
    public function index(){
        $recipeList = Recipe::all();
        $recipeList = Recipe::paginate(self::PAGINATE_SIZE);
        return view('recipe/all', ['recipeList'=>$recipeList],compact('recipeList'));
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
        return view('recipe.show', ['recipe' => $recipe, 'ingredients' => $ingredients, 'categories' => $categories]);
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
        $recipe->ingredients()->sync($request->ingredients);

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
        $recipe->ingredients()->sync($request->ingredients ?? []);

        return redirect()->route('recipe.index');
    }

    public function destroy($id)
    {
        $recipe = Recipe::find($id);
        $recipe->delete();
        return redirect()->route('recipe.index');
    }
}
