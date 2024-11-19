<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Models\Category;
use App\Models\User;
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
            return redirect(route('task.index'));
        } else {
            return redirect(route('loginPage'));
        }
    }

    public function forget()
    {
        return view('Auth.forget');
    }

    public function forgetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();

        $rand = rand(100000, 999999);

        SendEmail::dispatch($user->email, $rand);

        $user->update([
            'password' => Hash::make($rand),
        ]);
        return redirect(route('loginPage'));
    }

    public function logout()
    {
        auth()->logout();
        return redirect(route('loginPage'));
    }

    public function index()
    {
        $models = User::orderBy('id', 'asc')->paginate(10);
        return view('Auth.index', ['models' => $models]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create($data);

        return redirect()->route('user.index');
    }

    public function update(Request $request, User $user)
    {

        //dd($user);
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|min:6',
        ]);
        //dd($user);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->save();
        return redirect()->route('user.index');
    }

    public function delete(Request $request, User $user)
    {
        $destroy = $user->findOrFail($request->id);
        $destroy->delete();
        return redirect()->route('user.index');
    }
}
