<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //funkcija za registraciju
    public function register(Request $request) {

        //ogranicenja unesenih podataka tj njihova validacija 
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:100|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        //ako nije uspesna validacija
        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        //ako je uspesna ubacuju se podaci za novog korisnika
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) 
        ]);

        //kreira se jedinstven token za registrovanog korisnika 
        $token = $user->createToken('auth_token')->plainTextToken;

        //ispisivanje u postman-u
        return response()->json(['data'=> $user, 'access_token'=> $token, 'token_type' => 'Bearer']);
    }


    //funkcija za login
    public function login(Request $request) {

        if(! Auth::attempt($request->only('email','password'))) {
            return response()->json(['message'=>'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message'=>'Hello '.$user->name. '! Welcome to our website', 'access_token'=> $token, 'token_type' => 'Bearer']);
    }

    public function logout() {
        //auth()->user()->tokens()->delete();
        return ['message'=>'User succesfully logged out'];
    }
}
