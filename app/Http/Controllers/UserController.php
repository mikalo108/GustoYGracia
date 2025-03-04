<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private const PAGINATE_SIZE = 5;
    public function index(){
        $userList = User::all();
        $userList = User::orderBy('id', 'desc')->paginate(self::PAGINATE_SIZE);
        return view('user/all', ['userList' => $userList], compact('userList'));
    }

    public function show($id)
    {
        $user = User::with('contact')->findOrFail($id);
        return view('user.show', ['user' => $user]);
    }

    public function showMyProfile()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user) {
            $user->load('contact');
        }
        return view('myProfile', compact('user'));
    }

    public function create()
    {
        return view('user/form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',  // El nombre debe ser obligatorio, una cadena y no más de 255 caracteres
            'email' => 'required|email',
        ]);    

        // Crear el contacto primero (con los valores por defecto o nulos)
        $contact = new Contact();
        $contact->name = $request->contactName ?? null;
        $contact->surname = $request->contactSurname ?? null;
        $contact->bio = $request->contactBio ?? null;
        $contact->phone = $request->contactPhone ?? null;
        $contact->country = $request->contactCountry ?? null;
        $contact->city = $request->contactCity ?? null;
        $contact->save();

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
        return view('user/form', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',  // El nombre debe ser obligatorio, una cadena y no más de 255 caracteres
            'email' => 'required|email|unique:users,email',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        $contact= Contact::find($user->contact->id);
        $contact->name = $request->contactName ?? null;
        $contact->surname = $request->contactSurname ?? null;
        $contact->bio = $request->contactBio ?? null;
        $contact->phone = $request->contactPhone ?? null;
        $contact->country = $request->contactCountry ?? null;
        $contact->city = $request->contactCity ?? null;
        $contact->save();

        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if($user->contact){
            $contact = Contact::find($user->contact->id);
            $contact->delete();
        }
        $user->delete();
        return redirect()->route('user.index');
    }
}
