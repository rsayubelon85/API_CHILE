<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:20|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)|unique:categories,name,'
            ]);            
    
            Categorie::create([
                'name' => $request->name
            ]);
            
            $token = auth()->user()->createToken('Token')->accessToken;
    
            return response()->json(['token' => $token,'status' => 'success'],200);

        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }

    }

    public function edit(Categorie $categorie)
    {
        return response()->json($categorie);
    }

    public function update(Request $request, Categorie $categorie)
    {
        try {
            
            $request->validate([
                'name' => 'required|string|max:50|regex:([a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+)'
            ]);

            $categorie->name = $request->name;

            $categorie->touch();

            $token = auth()->user()->createToken('Token')->accessToken;
    
            return response()->json(['token' => $token,'status' => 'success'],200);

        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }
    }

    public function destroy(Categorie $categorie)
    {
        try {
            $categorie->delete();

            $token = auth()->user()->createToken('Token')->accessToken;
    
            return response()->json(['token' => $token,'status' => 'success'],200);
        
        } catch (\Throwable $th) {
            return response()->json(['mensaje' => $th->getMessage(),'status' => 'error'],500);
        }
    }
}
