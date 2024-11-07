<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login logic
    // Inside LoginController.php

    public function login(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if (Auth::attempt([
            'email' => $validatedData['email'],
            'password' => $validatedData['password']
        ])) {

            return redirect()->intended('posts
            ');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }
}
