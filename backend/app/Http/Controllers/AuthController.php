<?php

namespace App\Http\Controllers;

use App\Models\AccessToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Login User
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);


        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
            ], 400);
        }

        $token = $this->generateToken($user);

        return response()->json([
            'data' => [
                'email' => $user->email,
                'role' => $user->role,
                'token' => $token,
            ]
        ], 200);
    }

    // Generate User Token
    private function generateToken(User $user)
    {
        $token = Str::random(35);

        AccessToken::create([
            'user_id' => $user->id,
            'token' => $token,
        ]);

        return $token;
    }


    // Logout user
    public function logout(Request $request)
    {
        if (!is_null($request->user)) {
            AccessToken::where('user_id', $request->user['id'])->delete();
        }

        return response()->json([
            'message' => 'User logged out successfully !'
        ], 201);
    }
}
