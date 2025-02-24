<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() { 
        $categoryList = Category::all();
        return view('category/all', ['categoryList'=>$categoryList]);
    }

    public function create() { 
        $categories = Category::all();
        return view('category/form', ['categories' => $categories]);  
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
