<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request){
        
        try {
            $request->validate([
                'name' => 'required|string|max:50|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)|unique:users,name',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => ['required',Password::defaults()->min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
                'password_confirmation' => 'required|same:password'  
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $id_rol = $request->role_id;
            $rol = Role::findById($id_rol);
            $user->assignRole($rol);
    
            $token = $user->createToken('Token')->accessToken;
    
            return response()->json(['token' => $token,'status' => 'success'],200);
            
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }

    }

    public function edit(User $user){
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        try {
            if($request->password == null){
                $request->validate([
                    'name' => 'required|string|max:50|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)|unique:users,name,'.$user->id
                ]);
    
                $user->name = $request->name;
            }
            else {
                $request->validate([
                    'password' => ['required',Password::defaults()->min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
                    'password_confirmation' => 'required|same:password'
                ]);
    
                $user->password = Hash::make($request->password);
            }
            $user->touch();

            $rol = $user->roles[0];
            $user->removeRole($rol);
            $rol = Role::findById($request->role_id);
            $user->assignRole($rol);
                
            $token = $user->createToken('Token')->accessToken;
    
            return response()->json(['token' => $token,'status' => 'success'],200);
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }        
 
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();

            $token = $user->createToken('Token')->accessToken;
    
            return response()->json(['token' => $token,'status' => 'success'],200);
        
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }
    }

}
