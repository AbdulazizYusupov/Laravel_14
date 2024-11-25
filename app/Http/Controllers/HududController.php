<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\HududStore;
use App\Http\Requests\HududUpdate;
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

    public function store(HududStore $request)
    {
        $validated = $request->validated();

        Hudud::create([
            'name' => $validated['name'],
        ]);

        return redirect()->route('hudud.index');
    }

    public function update(HududUpdate $request, Hudud $hudud, int $id)
    {
        $validated = $request->validated();

        $hudud->where('id', $id)->update([
            'name' => $validated['name'],
        ]);

        return redirect()->route('hudud.index');
    }

    public function delete(Request $request, Hudud $hudud)
    {
        $destroy = $hudud->findOrFail($request->id);
        $destroy->delete();
        return redirect()->route('hudud.index');
    }
}
