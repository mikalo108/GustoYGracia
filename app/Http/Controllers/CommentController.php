<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Recipe;

class CommentController extends Controller
{
    const PAGINATE_SIZE = 4;
    public function index() { 
        $commentList = Comment::all();
        $commentList = Comment::paginate(self::PAGINATE_SIZE);
        return view('comment/all', ['commentList'=>$commentList], compact('commentList'));
    }
    public function create() { 
        $users = User::all();
        return view('comment/form',['users'=>$users]);  
    }
    public function store(Request $r) { 
        $r->validate([
            'user' => 'required|exists:users,id',  // El usuario debe ser un ID válido en la tabla 'users'
            'recipe' => 'required|exists:recipes,id',  // La receta debe ser un ID válido en la tabla 'recipes'
            'content' => 'required|string|max:1000',  // El contenido del comentario debe ser una cadena y no superar los 1000 caracteres
        ]);

        $c = new Comment();
        $c->user_id = $r->user->id;
        $c->recipe_id = $r->recipe->id;
        $c->content = $r->content;
        $c->save();
        return redirect()->route('comment.index');
    }
    public function edit($id)
    {
        $comment = Comment::find($id);
        $users = User::all();
        return view('comment/form',['users'=>$users, 'comment'=>$comment]);  
    }

    public function update($id, Request $r) { 
        $r->validate([
            'user' => 'required|exists:users,id',  // El usuario debe ser un ID válido en la tabla 'users'
            'recipe' => 'required|exists:recipes,id',  // La receta debe ser un ID válido en la tabla 'recipes'
            'content' => 'required|string|max:1000',  // El contenido del comentario debe ser una cadena y no superar los 1000 caracteres
        ]);
        
        $c = Comment::find($id);
        $c->content = $r->content;
        $c->save();
        return redirect()->route('comment.index');
    }
    public function destroy($id) { 
        $c = Comment::find($id);
        $c->delete();
        return redirect()->route('comment.index');
    }
}
