<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index() { 
        $c = Contact::all();
        return view('contact/all', ['contactList'=>$c]);
    }

    public function create() { 
        return view('contact/form');  
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
        $c = Contact::find($id);
        return view('contact/form', ['contact' => $c]);
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
