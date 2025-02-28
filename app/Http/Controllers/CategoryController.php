<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categoryList = Category::all();  // Obtener todas las categorías
        return view('home', ['categoryList' => $categoryList]);
    }    

    public function showCategories()
    {
        $categoryList = Category::all();  // Obtener todas las categorías
        return view('category.index', ['categoryList' => $categoryList]);  // Esta vista es para la página de categorías
    }

    public function create() { 
        return view('category/form');  
    }

    public function store(Request $r) { 
        $c = new Category();
        $c->name = $r->name;
        $c->description = $r->description;
        $c->save();
        return redirect()->route('category.index');
    }

    public function edit($id) { 
        $c = Category::find($id);
        return view('category/form', ['category' => $c]);
    }

    public function update($id, Request $r) { 
        $c = Category::find($id);
        $c->name = $r->name;
        $c->description = $r->description;
        $c->save();
        return redirect()->route('category.index');
    }
    public function destroy($id) { 
        $c = Category::find($id);
        $c->delete();
        return redirect()->route('category.index');
    }
}
