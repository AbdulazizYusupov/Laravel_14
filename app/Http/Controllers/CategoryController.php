<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $models = Category::orderBy('id', 'asc')->paginate(10);
        return view('category.index', ["models" => $models]);
    }

    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();

        Category::create([
            'name' => $validated['name'],
        ]);

        return redirect()->route('category.index');
    }


    public function update(CategoryRequest $request, Category $category, int $id)
    {
        $validated = $request->validated();

        $category->where('id', $id)->update([
            'name' => $validated['name'],
        ]);

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
