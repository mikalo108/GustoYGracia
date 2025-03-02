<?php

namespace App\Http\Controllers;

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

    public function show()
    {
        $categoryList = Category::all();  // Obtener todas las categorías
        return view('category/show', ['categoryList' => $categoryList]);  // Esta vista es para la página de categorías
    }

    public function create()
    {
        return view('category/form');
    }

    public function store(Request $r)
    {
        $c = new Category();
        $c->name = $r->name;
        $c->description = $r->description;
        $c->save();
        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $c = Category::find($id);
        return view('category/form', ['category' => $c]);
    }

    public function update($id, Request $r)
    {
        $c = Category::find($id);
        $c->name = $r->name;
        $c->description = $r->description;
        $c->save();
        return redirect()->route('category.index');
    }
    public function destroy($id)
    {
        $c = Category::find($id);
        $c->delete();
        return redirect()->route('category.index');
    }
}
