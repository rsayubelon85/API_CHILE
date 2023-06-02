<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class PassportAuthController extends Controller
{
    public function login(Request $request){
        
        try {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];
    
            if (auth()->attempt($credentials)) {
                
                $token =  auth()->user()->createToken('Token')->accessToken;
    
                return response()->json(['token' => $token],200);
                
            }
            else{
                return response()->json(['error' => 'Credenciales erroneas']);
            }
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }
     
    }

    public function logout (){

        $token = auth()->user()->token();

        $token->revoke();

        return response()->json(['success' => 'Logout successfully']);
        
    }
}
