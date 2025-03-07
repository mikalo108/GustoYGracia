<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Recipe;

class CommentController extends Controller
{
    // Constante que define el número de elementos al mostrar en la página de inicio
    private const PAGINATE_SIZE = 4;

    // Función que devuelve a la página de inicio con los elementos que debe mostrar filtrados. Si la query está vacía, devuelve todos los elementos.
    public function index(Request $request) { 

        $query = Comment::query();
        // Filtrar por id del usuario (relación belongsTo)
        if ($request->filled('commentUserId')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('id', 'like', '%' . $request->commentUserId . '%');
            });
        }

        // Filtrar por id de la receta (relación belongsTo)
        if ($request->filled('commentRecipeId')) {
            $query->whereHas('recipe', function ($q) use ($request) {
                $q->where('id', 'like', '%' . $request->commentRecipeId . '%');
            });
        }

        // Obtener las recetas paginadas y ordenadas por ID ascendente
        $commentList = $query->orderBy('id', 'desc')->paginate(self::PAGINATE_SIZE);

        return view('comment/all', compact('commentList'))
            ->with([
                'commentUserId' => $request->commentUserId,
                'commentRecipeId' => $request->commentRecipeId,
            ]);
    }

    //  Función para devolver a la página de detalles del elemento que se pide
    public function show($id){
        $comment = Comment::findOrFail($id);
        return view('comment/show', compact('comment'));
    }
    
    //  Función para devolver a la página de creación del elemento
    public function create()
    {
        $users = User::all();
        return view('comment/form', ['users' => $users]);
    }
    
    //  Función para guardar el elemento en la base de datos
    public function store(Request $r) { 
        $r->validate([
            'content' => 'required|string|max:1000',
        ]);

        $c = new Comment();
        $c->user_id = $r->user_id;
        $c->recipe_id = $r->recipe_id;
        $c->content = $r->content;
        $c->save();
        return redirect()->route('comment.index');
    }

    //  Función para guardar el elemento en la base de datos por el usuario
    public function createComment(Request $r, $recipe, $user)
    {
        // Validación (opcional, pero recomendable)
        $r->validate([
            'content' => 'required|max:1000',
        ]);

        // Crear el comentario
        $comment = new Comment();
        $comment->user_id = $user; // Aquí $user es el ID, no un objeto
        $comment->recipe_id = $recipe; // Aquí $recipe es el ID, no un objeto
        $comment->content = $r->content;
        $comment->save();

        return redirect()->route('recipe.show', $recipe)->with('success', 'Comentario agregado correctamente');
    }

    //  Función para devolver a la página de edición del elemento
    public function edit($id)
    {
        $comment = Comment::find($id);
        $users = User::all();
        return view('comment/form',['users'=>$users, 'comment'=>$comment]);  
    }

    //  Función para actualizar el elemento en la base de datos
    public function update($id, Request $r) { 
        $r->validate([
            'content' => 'required|string|max:1000',
        ]);
        
        $c = Comment::find($id);
        $c->content = $r->content;
        $c->save();
        return redirect()->route('comment.index');
    }
    //  Funcion para eliminar el elemento de la base de datos
    public function destroy($id)
    {
        $c = Comment::find($id);
        $c->delete();
        return redirect()->route('comment.index');
    }

    //  Funcion para eliminar el elemento de la base de datos por el usuario
    public function removeComment($recipe, $comment)
    {
        $c = Comment::find($comment);
        $c->delete();
        return redirect()->route('recipe.show', $recipe)->with('success', 'Comentario eliminado correctamente.');
    }
}
