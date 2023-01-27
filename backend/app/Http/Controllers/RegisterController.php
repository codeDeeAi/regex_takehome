<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Register User
    public function register(RegisterUserRequest $request)
    {
        User::create([
            'email' => $request->email,
            'role' => (!is_null($request->is_admin) && $request->is_admin == true) ? 'admin' : 'user',
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User created successfully !'
        ]);
    }
}
