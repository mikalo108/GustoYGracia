<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index() { 
        $commentsList = Comment::all();
        return view('comment/all', ['commentsList'=>$commentsList]);
    }

    public function create() { 
        $comments = Comment::all();
        return view('comment/form', ['comments' => $comments]);  
    }

    public function store(Request $r) { 
        $c = new Comment();
        $c->user_id = $r->user_id;
        $c->recipe_id = $r->recipe_id;
        $c->content = $r->content;
        $c->save();
        return redirect()->route('comment.index');
    }

    public function edit($id) { 
        $c = Comment::find($id);
        return view('comment/form', ['comment' => $c]);
    }

    public function update($id, Request $r) { 
        $c = Comment::find($id);
        $c->user_id = $r->user_id;
        $c->recipe_id = $r->recipe_id;
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
