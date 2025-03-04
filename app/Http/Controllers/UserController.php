<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private const PAGINATE_SIZE = 5;
    public function index(Request $request){
        
        $query = User::query();

        // Filtrar por id del usuario
        if ($request->filled('user_id')) {
            $query->where('id', 'like', '%' . $request->user_id . '%');
        }
        // Filtrar por nombre del usuario
        if ($request->filled('userName')) {
            $query->where('name', 'like', '%' . $request->userName . '%');
        }
    
        // Filtrar por email del usuario
        if ($request->filled('userEmail')) {
            $query->where('email', 'like', '%' . $request->userEmail . '%');
        }

        // Filtrar por nombre de contacto (relación belongsTo)
        if ($request->filled('userContactName')) {
            $query->whereHas('contact', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->userContactName . '%');
            });
        }

         // Obtener las recetas paginadas y ordenadas por ID ascendente
         $userList = $query->orderBy('id', 'desc')->paginate(self::PAGINATE_SIZE);

        return view('user/all', compact('userList'))
            ->with([
                'user_id' => $request->user_id,
                'userName' => $request->userName,
                'userEmail' => $request->userEmail,
                'userContactName' => $request->userContactName,
            ]);
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

    public function updateMyProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',  // El nombre debe ser obligatorio, una cadena y no más de 255 caracteres
            'email' => 'required|email|unique:users,email',  // El correo debe ser obligatorio, válido y único en la base de datos
            'password' => 'required|string|min:8',  // La contraseña es obligatoria y debe tener al menos 8 caracteres
            'contactName' => 'nullable|string|max:255',  // El nombre del contacto es opcional, debe ser una cadena y no superar los 255 caracteres
            'contactSurname' => 'nullable|string|max:255',  // El apellido del contacto es opcional, debe ser una cadena y no superar los 255 caracteres
            'contactBio' => 'nullable|string|max:1000',  // La biografía es opcional, debe ser una cadena y no superar los 1000 caracteres
            'contactPhone' => 'nullable|string|max:20',  // El teléfono es opcional, debe ser una cadena y no superar los 20 caracteres
            'contactCountry' => 'nullable|string|max:255',  // El país es opcional, debe ser una cadena y no superar los 255 caracteres
            'contactCity' => 'nullable|string|max:255',  // La ciudad es opcional, debe ser una cadena y no superar los 255 caracteres
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
        return redirect()->route('myProfile');
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
