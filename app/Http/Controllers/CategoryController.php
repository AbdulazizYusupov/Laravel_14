<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $models = Category::orderBy('id', 'asc')->paginate(10);
        return view('category.index', ["models" => $models]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
        ]);

        Category::create($data);

        return redirect()->route('category.index');
    }

    public function update(Request $request, Category $category, int $id)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
        ]);
        $category->where('id', $id)->update($data);

        return redirect()->route('category.index');
    }

    public function delete(Request $request, Category $category)
    {
        $destroy = $category->findOrFail($request->id);
        $destroy->delete();
        return redirect()->route('category.index');
    }

    public function active(Request $request, Category $category)
    {
        $category
            ->where('id', $request->id)
            ->update(['status' => $request->active]);
        return redirect(route('category.index'))->with('update', 'Updated');
    }
}
