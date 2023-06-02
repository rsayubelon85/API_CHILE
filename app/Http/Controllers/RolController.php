<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{

    public function __construct()
    {
        //$this->middleware('can:rol.admin')->only('roles','index','create','store','edit','update','destroy');
    }

    public function index()
    {       
        try {

            $roles = Role::all();

            return response()->json($roles);

        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:20|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)|unique:roles,name'   
            ]);
            $rol = Role::create(['name'=> $request['name']]);

            $token = auth()->user()->createToken('Token')->accessToken;
    
            return response()->json(['token' => $token,'status' => 'success'],200);

        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }
    }

    public function edit(Role $role)
    {
        return response()->json($role);
    }

    public function update(Request $request, Role $role)
    {

        
        try {
            $request->validate([
                'name' => 'required|max:50|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)|unique:roles,name,'.$role->id,
            ]);    

            $role->name = $request['name'];
            $role->touch();

            $token = auth()->user()->createToken('Token')->accessToken;
    
            return response()->json(['token' => $token,'status' => 'success'],200);
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }



    }

    public function destroy(Role $role)
    {
        try {
            if($role->users()->count() > 0){
                return response()->json(['mensaje' => 'El rol no se puede eliminar porque está asignado a un usuario.','status' => 'error'],500);          
            }
            elseif ($role->permissions()->count() > 0) {
                return response()->json(['mensaje' => 'El rol no se puede eliminar porque tiene asignado permisos.','status' => 'error'],500); 
            }
            else{          
                $role->delete();

                $token = auth()->user()->createToken('Token')->accessToken;
    
                return response()->json(['token' => $token,'status' => 'success'],200);
            }            
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }
    }

}
