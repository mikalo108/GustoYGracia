<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    public function index() { 
        $ingredientList = Ingredient::all();
        return view('ingredient/all', ['ingredientList'=>$ingredientList]);
    }

    public function create() { 
        return view('ingredient/form');  
    }

    public function store(Request $r) { 
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
