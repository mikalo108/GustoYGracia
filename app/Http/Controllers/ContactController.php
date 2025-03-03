<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    const PAGINATE_SIZE = 4;
    public function index() { 
        $contactList = Contact::all();
        $contactList = Contact::paginate(self::PAGINATE_SIZE);
        return view('contact/all', ['contactList'=>$contactList], compact('contactList'));
    }

    public function create() { 
        $users = User::all();
        return view('contact/form',['users'=>$users]);  
    }

    public function store(Request $r) { 
        $r->validate([
            'name' => 'required|string|max:255',  // El nombre debe ser una cadena de texto y no superar los 255 caracteres
            'surname' => 'required|string|max:255',  // El apellido debe ser una cadena de texto y no superar los 255 caracteres
            'bio' => 'nullable|string|max:1000',  // La biografía es opcional, pero si se ingresa, no debe superar los 1000 caracteres
            'phone' => 'required|string|max:15',  // El teléfono debe ser una cadena y no debe superar los 15 caracteres
            'country' => 'required|string|max:255',  // El país debe ser una cadena y no superar los 255 caracteres
            'city' => 'required|string|max:255',  // La ciudad debe ser una cadena y no superar los 255 caracteres
        ]);
        
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
        $r->validate([
            'name' => 'required|string|max:255',  // El nombre debe ser una cadena de texto y no superar los 255 caracteres
            'surname' => 'required|string|max:255',  // El apellido debe ser una cadena de texto y no superar los 255 caracteres
            'bio' => 'nullable|string|max:1000',  // La biografía es opcional, pero si se ingresa, no debe superar los 1000 caracteres
            'phone' => 'required|string|max:15',  // El teléfono debe ser una cadena y no debe superar los 15 caracteres
            'country' => 'required|string|max:255',  // El país debe ser una cadena y no superar los 255 caracteres
            'city' => 'required|string|max:255',  // La ciudad debe ser una cadena y no superar los 255 caracteres
        ]);

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
