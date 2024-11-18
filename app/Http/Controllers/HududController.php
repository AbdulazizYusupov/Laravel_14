<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hudud;
use App\Models\User;
use Illuminate\Http\Request;

class HududController extends Controller
{
    public function index()
    {
        $users = User::all();
        $models = Hudud::orderBy('id', 'asc')->paginate(10);
        return view('hudud.index', ["models" => $models,'users' => $users]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'user_id' => 'required',
        ]);

        Hudud::create($data);

        return redirect()->route('hudud.index');
    }

    public function update(Request $request, Hudud $hudud, int $id)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'user_id' => 'required',
        ]);

        $hudud->where('id', $id)->update($data);

        return redirect()->route('hudud.index');
    }

    public function delete(Request $request, Hudud $hudud)
    {
        $destroy = $hudud->findOrFail($request->id);
        $destroy->delete();
        return redirect()->route('hudud.index');
    }
}
