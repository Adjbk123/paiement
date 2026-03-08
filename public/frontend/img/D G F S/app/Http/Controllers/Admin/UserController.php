<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users  = User::paginate(10);
        return view('admin.user.index' , compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', ],
            'role_as' => ['required', 'integer' ],

        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as,
            
        ]);
        return redirect('/admin/users')->with('message' , 'utilisateur Crer Avec Success');
    }

    public function update(Request $request , int  $userId)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:4', ],
            'role_as' => ['required', 'integer' ],

        ]);
        User::findOrFail($userId)->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as,
            
        ]);
        return redirect('/admin/users')->with('message' , 'Les Informations Sont Modifier avec Success');
    }


    public function edit(int $userId)
    {
        $user  = User::findOrFail($userId);
        return view('admin.user.edit' , compact('user'));
    }
    public function destroy( int $userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect('/admin/users')->with('message' , 'Utilisateur Suprimer Avec Succes');
    }
}
