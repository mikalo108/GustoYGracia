<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    // Constante que define el número de elementos al mostrar en la página de inicio
    private const PAGINATE_SIZE = 4;

    // Función que devuelve a la página de inicio con los elementos que debe mostrar filtrados. Si la query está vacía, devuelve todos los elementos.
    public function index(Request $request) { 
        $query = Ingredient::query();
        // Filtrar por nombre del ingrediente
        if ($request->filled('ingredientName')) {
            $query->where('name', 'like', '%' . $request->ingredientName . '%');
        }
    
        // Filtrar por descripción del ingrediente
        if ($request->filled('ingredientDescription')) {
            $query->where('description', 'like', '%' . $request->ingredientDescription . '%');
        }

        // Filtrar por calorías del ingrediente
        if ($request->filled('ingredientCalories')) {
            $query->where('calories_per_100g', 'like', '%' . $request->ingredientCalories . '%');
        }

         // Obtener las recetas paginadas y ordenadas por ID ascendente
         $ingredientList = $query->orderBy('id', 'desc')->paginate(self::PAGINATE_SIZE);

        return view('ingredient/all', compact('ingredientList'))
            ->with([
                'ingredientName' => $request->ingredientName,
                'ingredientDescription' => $request->ingredientDescription,
                'ingredientCalories' => $request->ingredientCalories,
            ]);
    }

    //  Función para devolver a la página de detalles del elemento que se pide
    public function show($id){
        $ingredient = Ingredient::findOrFail($id);
        return view('ingredient/show', compact('ingredient'));
    }

    //  Función para devolver a la página de creación del elemento
    public function create() {
        return view('ingredient/form');  
    }

    //  Función para guardar el elemento en la base de datos
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

    //  Función para devolver a la página de edición del elemento
    public function edit($id) { 
        $i = Ingredient::find($id);
        return view('ingredient/form', ['ingredient' => $i]);
    }

    //  Función para actualizar el elemento en la base de datos
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

    //  Funcion para eliminar el elemento de la base de datos
    public function destroy($id) { 
        $i = Ingredient::find($id);
        $i->delete();
        return redirect()->route('ingredient.index');
    }
}
