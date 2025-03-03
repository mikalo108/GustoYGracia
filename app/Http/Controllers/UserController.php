<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    const PAGINATE_SIZE = 5;
    public function index()
    {
        $userList = User::all();
        $userList = User::paginate(self::PAGINATE_SIZE);
        return view('user/all', ['userList' => $userList], compact('userList'));
    }

    public function show($id)
    {
        $user = User::with('contact')->findOrFail($id);
        return view('user.show', ['user' => $user]);
    }

    public function showProfile()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user) {
            $user->load('contact');
        }
        return view('myprofile', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Crear el contacto primero (con los valores por defecto o nulos)
        $contact = new Contact();
        $contact->save(); // Guarda el contacto con los campos nulos

        // Luego, crea el usuario y asocia el contacto
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->contact_id = $contact->id;  // Asocia el contacto al usuario
        $user->save();

        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        // Si el usuario no tiene un contacto asociado, creamos uno nuevo
        if (!$user->contact_id) {
            $contact = new Contact();
            $contact->name = $request->contact_name;
            $contact->surname = $request->contact_surname;
            $contact->bio = $request->contact_bio;
            $contact->phone = $request->contact_phone;
            $contact->country = $request->contact_country;
            $contact->city = $request->contact_city;
            $contact->save();

            $user->contact_id = $contact->id;
        } else {
            // Si ya tiene un contacto, simplemente lo actualizamos
            $contact = Contact::find($user->contact_id);
            $contact->name = $request->contact_name;
            $contact->surname = $request->contact_surname;
            $contact->bio = $request->contact_bio;
            $contact->phone = $request->contact_phone;
            $contact->country = $request->contact_country;
            $contact->city = $request->contact_city;
            $contact->save();
        }

        $user->save();
        return redirect()->route('myprofile');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
