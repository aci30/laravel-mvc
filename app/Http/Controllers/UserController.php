<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request) {
        $validated = $request->validate([
            'username' => 'required|string|exists:users,name',
            'password' => 'required|string'
        ]);
       
        $user = User::where('name', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)){
            return response([
                'message' => 'Wrong password',
            ], 401);
        }

        // Issue admin special token
        if ($user->name === 'admin'){
            $token = $user->createToken('admin_token');
        } else {
            $token = $user->createToken('user_token');
        }
        
        return response([
            'user' => $user,
            'token' => $token->plainTextToken,
        ], 201);
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return response()->noContent();
    }




}
