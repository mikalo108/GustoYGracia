<?php

namespace App\Http\Controllers;

use App\Models\CategoryTranslation;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Recipe;

class CategoryController extends Controller
{
    // Constante que define el número de elementos al mostrar en la página de inicio
    private const PAGINATE_SIZE = 5;

    // Función que devuelve a la página de inicio con los elementos que debe mostrar filtrados. Si la query está vacía, devuelve todos los elementos.
    public function index(Request $request)
    {
        $query = Category::query();
        // Filtrar por nombre de la categoría
        if ($request->filled('categoryName')) {
            $query->where('name', 'like', '%' . $request->categoryName . '%');
        }
    
        // Filtrar por descripción de la categoría
        if ($request->filled('categoryDescription')) {
            $query->where('description', 'like', '%' . $request->categoryDescription . '%');
        }

         // Obtener las recetas paginadas y ordenadas por ID ascendente
         $categoryList = $query->orderBy('id', 'asc')->paginate(self::PAGINATE_SIZE);

        return view('category/all', compact('categoryList'))
            ->with([
                'categoryName' => $request->categoryName,
                'categoryDescription' => $request->categoryDescription,
            ]);
    }

    //  Función para devolver a la página de detalles del elemento que se pide
    public function show($id)
    {
        $category = Category::find($id);
        return view('category/show', ['category' => $category]);
    }

    //  Función para devolver a la página de creación del elemento
    public function create()
    {
        return view('category/form');
    }

    //  Función para guardar el elemento en la base de datos
    //  En este caso, hay que guardar los dos idiomas disponibles para esta tabla.
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

    //  Función para devolver a la página de edición del elemento
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

    //  Función para actualizar el elemento en la base de datos
    //  En este caso, hay que actualizar los dos idiomas disponibles para esta tabla.
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

    //  Funcion para eliminar el elemento de la base de datos
    public function destroy($id)
    {
        $c = Category::find($id);
        $c->delete();
        return redirect()->route('category.index');
    }
}
