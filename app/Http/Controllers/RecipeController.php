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
    public function create()
    {
        $ingredients = Ingredient::all();
        $categories = Category::all();
        return view('recipe.create', ['ingredients' => $ingredients, 'categories' => $categories]);
    }
    
    public function store(Request $request)
    {  
        $imagePath= $request->file('image')->store('recipe', 'public');
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
        
        if($request->hasFile('image')){
            if($recipe->image){
                Storage::delete($recipe->image);
            }

            $imagePath= $request->file('image')->store('recipe', 'public');
            $recipe->image=$imagePath;
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
}
