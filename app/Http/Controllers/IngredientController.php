<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    private const PAGINATE_SIZE = 4;
    public function index() { 
        $ingredientList = Ingredient::all();
        $ingredientList = Ingredient::paginate(self::PAGINATE_SIZE);
        return view('ingredient/all', ['ingredientList'=>$ingredientList], compact('ingredientList'));
    }

    public function create() {
        return view('ingredient/form');  
    }

    public function store(Request $r) { 
        $r->validate([
            'name' => 'required|string|max:255',  // El nombre del ingrediente debe ser obligatorio, una cadena y no superar los 255 caracteres
            'description' => 'nullable|string|max:1000',  // La descripción es opcional, pero si se proporciona, no debe superar los 1000 caracteres
            'calories_per_100g' => 'required|numeric|min:0',  // Las calorías por 100g deben ser un número mayor o igual a 0
        ]);

        $i = new Ingredient();
        $i->name = $r->name;
        $i->description = $r->description;
        $i->calories_per_100g=$r->calories_per_100g;
        $i->save();
        return redirect()->route('ingredient.index');
    }

    public function edit($id) { 
        $i = Ingredient::find($id);
        return view('ingredient/form', ['ingredient' => $i]);
    }

    public function update($id, Request $r) { 
        $r->validate([
            'name' => 'required|string|max:255',  // El nombre del ingrediente debe ser obligatorio, una cadena y no superar los 255 caracteres
            'description' => 'nullable|string|max:1000',  // La descripción es opcional, pero si se proporciona, no debe superar los 1000 caracteres
            'calories_per_100g' => 'required|numeric|min:0',  // Las calorías por 100g deben ser un número mayor o igual a 0
        ]);
        
        $i = Ingredient::find($id);
        $i->name = $r->name;
        $i->description = $r->description;
        $i->calories_per_100g=$r->calories_per_100g;
        $i->save();
        return redirect()->route('ingredient.index');
    }
    public function destroy($id) { 
        $i = Ingredient::find($id);
        $i->delete();
        return redirect()->route('ingredient.index');
    }
}
