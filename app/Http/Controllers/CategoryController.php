<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() { 
        $categoryList = Category::all();
        return view('categories/all', ['categoryList'=>$categoryList]);
    }

    public function create() { 
        $categories = Category::all();
        return view('categories/form', ['categories' => $categories]);  
    }

    public function store(Request $r) { 
        
    }

    public function edit($id) { 
    }

    public function update($id, Request $r) { 
        
    }
    public function destroy($id) { 
        
    }
}
