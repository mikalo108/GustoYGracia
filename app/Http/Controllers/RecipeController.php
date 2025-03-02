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
            'prep_time' => 'required|string',
            'difficulty_level' => 'required|string',
            'ingredients' => 'required|array',
            'categories' => 'required|array',
        ]);

        $imagePath= $request->file('image')->store('recipe', 'public');

        $recipe = new Recipe();
        $recipe->name = $request->name;
        $recipe->description = $request->description;
        $recipe->image = $imagePath;
        $recipe->user_id = $request->user_id;
        $recipe->instructions = $request->instructions;
        $recipe->save();

        $recipeDetail = new RecipeDetail();        
        $recipeDetail->recipe_id = $recipe->id;
        $recipeDetail->prep_time = $request->prep_time;
        $recipeDetail->difficulty_level = $request->difficulty_level;
        $recipeDetail->save();

        // Asignar categorías e ingredientes
        if ($request->has('categories')) {
            $recipe->categories()->sync($request->categories);
        }
        if ($request->has('ingredients')) {
            $recipe->ingredients()->sync($request->ingredients);
        }

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
            'prep_time' => 'required|string',
            'difficulty_level' => 'required|string',
            'ingredients' => 'nullable|array',
            'categories' => 'nullable|array',
        ]);
    
        $recipe = Recipe::findOrFail($id);
        $recipe->name = $request->name;
        $recipe->description = $request->description;
    
        // Actualizar imagen si se sube una nueva
        if ($request->hasFile('image')) {
            if ($recipe->image) {
                Storage::delete('public/' . $recipe->image);
            }
            $imagePath = $request->file('image')->store('recipe', 'public');
            $recipe->image = $imagePath;
        }
    
        $recipe->user_id = $request->user_id;
        $recipe->instructions = $request->instructions;
        $recipe->save();
    
        // Actualizar RecipeDetail
        $recipeDetail = $recipe->details;
        if ($recipeDetail) {
            $recipeDetail->prep_time = $request->prep_time;
            $recipeDetail->difficulty_level = $request->difficulty_level;
            $recipeDetail->save();
        }
    
        // Sincronizar categorías e ingredientes
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
