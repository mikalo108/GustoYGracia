<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index() { 
        $c = Contact::all();
        return view('contact/all', ['contactList'=>$c]);
    }

    public function create() { 
        $users = User::all();
        return view('contact/form',['users'=>$users]);  
    }

    public function store(Request $r) { 
        $c = new Contact();
        $c->name = $r->name;
        $c->surname = $r->surname;
        $c->bio = $r->bio;
        $c->phone = $r->phone;
        $c->country = $r->country;
        $c->city = $r->city;
        $c->save();
        return redirect()->route('contact.index');
    }

    public function edit($id) { 
        $users = User::all();
        $c = Contact::find($id);
        return view('contact/form', ['contact' => $c,'users'=>$users]);
    }

    public function update($id, Request $r) { 
        $c = Contact::find($id);
        $c->name = $r->name;
        $c->surname = $r->surname;
        $c->bio = $r->bio;
        $c->phone = $r->phone;
        $c->country = $r->country;
        $c->city = $r->city;
        $c->save();
        return redirect()->route('contact.index');
    }
    public function destroy($id) { 
        $c = Contact::find($id);
        $c->delete();
        return redirect()->route('contact.index');
    }
}
