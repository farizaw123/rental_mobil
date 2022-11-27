<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\formulir;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
             'name' => 'required|string|max:100',
             'email' => 'required|string|unique:users,email',
             'password' => 'required|string|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('tokenku',['user'])->plainTextToken;

        $response = [
         'user' => $user,
         'token' => $token
        ];

        return response ($response, 201);
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $validate = \Validator::make($input,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validate->fails()){
            return response()->json(['error' => $validate->errors()], 422);
        }

        if (Auth::guard('user')->attempt(['email' => $input['email'], 'password' => $input['password']])){
            $user = Auth::guard('user')->user();

            $token = $user->createToken('tokenku', ['user'])->plainTextToken;

            return response()->json(['token' => $token]);

        }
        else {
            return response([
                'message' => 'Unathorized'
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function getHistory()
    {
        $id_user = Auth::id();
        $history = formulir::where('id_user', $id_user)->get();
        return response()->json([
            "message" => "Load data success",
            "data" => $history
        ], 200);
    }
    

}