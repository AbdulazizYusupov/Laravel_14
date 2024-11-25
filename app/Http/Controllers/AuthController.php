<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login;
use App\Http\Requests\UserStore;
use App\Http\Requests\UserUpdate;
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

    public function login(Login $request)
    {
        $data = $request->validated();
        if (auth()->attempt($data)) {
            if (auth()->user()->role == 'admin') {
                return redirect(route('manage.index'));
            }else{
                return redirect(route('index'));
            }
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

    public function store(UserStore $request)
    {
        $data = $request->validated();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('user.index');
    }

    public function update(UserUpdate $request, User $user)
    {
        $data = $request->validated();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
        return redirect()->route('user.index');
    }

    public function delete(Request $request, User $user)
    {
        $destroy = $user->findOrFail($request->id);
        $destroy->delete();
        return redirect()->route('user.index');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('Auth.profile', ['user' => $user]);
    }
    public function updateProfile(UserUpdate $request, User $user)
    {
        $data = $request->validated();

        $user->name = $data['name'];
        $user->email = $data['email'];

        if ($data->filled('password')) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->route('profile');
    }

}
