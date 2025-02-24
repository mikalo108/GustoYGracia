<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Recipe;

class CommentController extends Controller
{
    public function index() { 
        $commentsList = Comment::all();
        return view('comment/all', ['commentsList'=>$commentsList]);
    }

    public function store(Request $r, $user, $recipe) { 
        $c = new Comment();
        $c->user_id = $user->id;
        $c->recipe_id = $recipe->id;
        $c->content = $r->content;
        $c->save();
        return redirect()->route('comment.index');
    }

    public function update($id, Request $r, $user, $recipe) { 
        $c = Comment::find($id);
        $c->user_id = $user->id;
        $c->recipe_id = $recipe->id;
        $c->content = $r->content;
        $c->save();
        return redirect()->route('comment.index');
    }
    public function destroy($id) { 
        $c = Comment::find($id);
        $c->delete();
        return redirect()->route('category.index');
    }
}
