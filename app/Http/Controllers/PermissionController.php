<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpParser\ErrorHandler\Collecting;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function index(){
        
        $permisos = Permission::all();
       
        return response()->json($permisos);
    }


    public function asignacion_permiso(Request $request)
    {
        return $request['array_perm'];
        try {
            $rol = Role::findById($request->role_id);
            if($request['array_perm'] != null){
    
                $permisos_int = $request['array_perm'];
                if ($rol->id === 1) {//Rol del administrador del sistema y lleva el permiso rol.admin (administrar el sistema)
                    
                    $permisos_entrada = Permission::wherein('id',$permisos_int)->orwhere('id',1)->get();                
                    $rol->syncPermissions($permisos_entrada);
    
                } else {
                    
                    $permisos_entrada = Permission::wherein('id',$permisos_int)->get();
                    $rol->syncPermissions($permisos_entrada);
                }
    
            }
            else{
                foreach ($rol->permissions as $perm) {
                    if($perm->id != 1)
                        $rol->revokePermissionTo($perm);
                }
    
            }

            $token = auth()->user()->createToken('Token')->accessToken;
    
            return response()->json(['token' => $token,'status' => 'success'],200);
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }

    }
}
