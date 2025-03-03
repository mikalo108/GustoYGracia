<?php

namespace App\Http\Controllers;

use App\Models\CategoryTranslation;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Recipe;

class CategoryController extends Controller
{
    const PAGINATE_SIZE = 5;
    public function index()
    {
        $categoryList = Category::all();  // Obtener todas las categorías
        $categoryList = Category::paginate(self::PAGINATE_SIZE);
        $recipeList = Recipe::all();  // Puedes aplicar filtros si necesitas alguna condición específica
        return view('category/all', [
            'categoryList' => $categoryList,
            'recipesList' => $recipeList,
        ], compact('categoryList'));
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('category/show', ['category' => $category]);
    }

    public function create()
    {
        return view('category/form');
    }

    public function store(Request $r)
    {
        $r->validate([
            'categoryNameEN' => 'required|string|max:255',  // Validación para el nombre en inglés
            'categoryDescriptionEN' => 'required|string|max:500',  // Validación para la descripción en inglés
            'categoryNameES' => 'required|string|max:255',  // Validación para el nombre en español
            'categoryDescriptionES' => 'required|string|max:500',  // Validación para la descripción en español
        ]);

        $c = new Category();
        $c->name = $r->categoryNameEN;
        $c->description = $r->categoryDescriptionEN;
        $c->save();
        $categoryId = $c->id;

        $cES = new CategoryTranslation();
        $cES->name = $r->categoryNameES;
        $cES->locale="es";
        $cES->description = $r->categoryDescriptionES;
        $cES->category_id=$categoryId;
        $cES->save();

        $cEN = new CategoryTranslation();
        $cEN->name = $r->categoryNameEN;
        $cEN->locale="en";
        $cEN->description = $r->categoryDescriptionEN;
        $cEN->category_id=$categoryId;
        $cEN->save();

        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $c = Category::find($id);
        $cES = CategoryTranslation::where('category_id', $id)
                                    ->where('locale', 'es')
                                    ->first();
        $cEN = CategoryTranslation::where('category_id', $id)
                    ->where('locale', 'en')
                    ->first();
        return view('category/form', ['category' => $c, 'cES'=>$cES , 'cEN'=>$cEN]);
    }

    public function update($id, Request $r)
    {
        $r->validate([
            'categoryNameEN' => 'required|string|max:255',  // Validación para el nombre en inglés
            'categoryDescriptionEN' => 'required|string|max:500',  // Validación para la descripción en inglés
            'categoryNameES' => 'required|string|max:255',  // Validación para el nombre en español
            'categoryDescriptionES' => 'required|string|max:500',  // Validación para la descripción en español
        ]);
        
        $c = Category::find($id);
        $c->name = $r->categoryNameEN;
        $c->description = $r->categoryDescriptionEN;
        $c->save();

        $cES = CategoryTranslation::where('category_id', $id)
                                    ->where('locale', 'es')
                                    ->first();
        $cES->name = $r->categoryNameES;
        $cES->locale="es";
        $cES->description = $r->categoryDescriptionES;
        $cES->category_id=$id;
        $cES->save();

        $cEN = CategoryTranslation::where('category_id', $id)
                                    ->where('locale', 'en')
                                    ->first();
        $cEN->name = $r->categoryNameEN;
        $cEN->locale="en";
        $cEN->description = $r->categoryDescriptionEN;
        $cEN->category_id=$id;
        $cEN->save();

        return redirect()->route('category.index');
    }
    public function destroy($id)
    {
        $c = Category::find($id);
        $c->delete();
        return redirect()->route('category.index');
    }
}
