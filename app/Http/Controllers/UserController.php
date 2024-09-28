<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(){
        return view('website.register_login');
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()->with('status', implode(' ', $errors))->with('status_type', 'error');

            // return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            session(['user' => auth()->user()]);

            return redirect()->back()->with('status', 'Logged in successfully.')->with('status_type', 'success');
        }
        return redirect()->back()->with('status', 'The provided credentials do not match our records')->with('status_type', 'error');
        // return response()->json(['errors' => ['email' => 'The provided credentials do not match our records.']], 401);
    }

    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:200|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()->with('status', implode(' ', $errors))->with('status_type', 'error');
        }

        try {
            $token = (string) Str::uuid();
            $user = User::create([
                'userid' => $token,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user);
            session(['user' => auth()->user()]);
            return redirect()->back()->with('status', 'Thank you for signing up! Your account has been created successfully.')->with('status_type', 'success');
        } catch (\Exception $e) {
            Log::error('Sign-up error: ' . $e->getMessage());
            return redirect()->back()->with('status', 'An error occurred during registration. Please try again.')->with('status_type', 'error');
        }
    }
    public function myaccount(Request $request)
    {
        $user = session('user');
        if (!$user) {
            return view('website.register_login');
        }
        return view('website.myaccount');
    }
    public function logout()
    {
        Auth::logout();
        session()->forget('user');
        return redirect('/');
    }
}
