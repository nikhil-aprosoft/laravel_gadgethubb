<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json(['success' => 'Logged in successfully']);
        }

        return response()->json(['errors' => ['email' => 'The provided credentials do not match our records.']], 401);
    }

    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|min:2|max:100',
            'email'    => 'required|string|email|max:200|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone'    => 'nullable|numeric|regex:/^\+?[0-9]{10,}$/|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $token = (string) Str::uuid();
            $user = User::create([
                'userid'   => $token,
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'phone'    => $request->phone,
            ]);

            Auth::login($user);

            return response()->json(['success' => 'Thank you for signing up! Your account has been created successfully.']);
        } catch (\Exception $e) {
            Log::error('Sign-up error: ' . $e->getMessage());
            return response()->json(['errors' => ['email' => 'An error occurred during registration. Please try again.']], 500);
        }
    }
}
