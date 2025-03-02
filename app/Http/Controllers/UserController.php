<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;

class UserController extends Controller
{
    const PAGINATE_SIZE = 5;
    public function index(){
        $userList = User::all();
        $userList = User::paginate(self::PAGINATE_SIZE);
        return view('user/all', ['userList'=>$userList],compact('userList'));
    }
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada (por ejemplo, validaciones para name, email y password)
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
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
