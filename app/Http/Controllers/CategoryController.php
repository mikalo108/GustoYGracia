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
        $c = Category::find($id);
        $c->name = $r->name;
        $c->description = $r->description;
        $c->save();

        $cES = CategoryTranslation::where('category_id', $id)
                                    ->where('locale', 'es');
        $cES->name = $r->categoryNameES;
        $cES->locale="es";
        $cES->description = $r->categoryDescriptionES;
        $cES->category_id=$id;
        $cES->save();

        $cEN = CategoryTranslation::where('category_id', $id)
                                    ->where('locale', 'en');
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
