<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('Auth.login');
    }
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);
        if (auth()->attempt($data)) {
            return redirect(route('category.index'));
        }else{
            return redirect(route('loginPage'));
        }
    }
    public function forget ()
    {
        return view('Auth.forget');
    }
    public function logout()
    {
        auth()->logout();
    }
}
