<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Recipe;

class CommentController extends Controller
{
    const PAGINATE_SIZE = 4;
    public function index()
    {
        $commentList = Comment::all();
        $commentList = Comment::paginate(self::PAGINATE_SIZE);
        return view('comment/all', ['commentList' => $commentList], compact('commentList'));
    }
    public function create()
    {
        $users = User::all();
        return view('contact/form', ['users' => $users]);
    }
    public function store(Request $r, $user, $recipe)
    {
        $c = new Comment();
        $c->user_id = $user->id;
        $c->recipe_id = $recipe->id;
        $c->content = $r->content;
        $c->save();
        return redirect()->route('comment.index');
    }

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

    public function edit($id)
    {
        $comment = Comment::find($id);
        $users = User::all();
        return view('contact/form', ['users' => $users, 'comment' => $comment]);
    }

    public function update($id, Request $r, $user, $recipe)
    {
        $c = Comment::find($id);
        $c->user_id = $user->id;
        $c->recipe_id = $recipe->id;
        $c->content = $r->content;
        $c->save();
        return redirect()->route('comment.index');
    }
    public function destroy($comment, $recipe)
    {
        $c = Comment::find($comment);
        $c->delete();
        return redirect()->route('recipe.show', $recipe);
    }

    public function removeComment($recipe, $comment)
    {
        $c = Comment::find($comment);
        $c->delete();

        return redirect()->route('recipe.show', $recipe)->with('success', 'Comentario eliminado correctamente.');
    }
}
