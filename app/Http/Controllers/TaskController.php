<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Hudud;
use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Models\TaskRegion;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = TaskRegion::orderBy('id', 'asc')->paginate(10);
        return view('Task.index', ['models' => $models]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hududs = Hudud::all();
        $categories = Category::all();
        return view('Task.create', ['categories' => $categories, 'hududs' => $hududs]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'title' => 'required|max:255',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,svg,pdf,docx,xls,xlsx|max:4096',
            'category_id' => 'required',
            'data' => 'required|date',
            'hududs' => 'required|array',
            'hududs.*' => 'exists:hududs,id',
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = date('Y-m-d') . '_' . $extension;
            $file->move('files/', $filename);
            $data['file'] = $filename;
        }

        $task = Task::create($data);

        foreach ($request->hududs as $hudud) {
            $task->HududTask()->create([
                'hudud_id' => $hudud,
                'status' => '1'
            ]);
        }
        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskRegion $task)
    {
        $hududs = Hudud::all();
        $categories = Category::all();
        return view('Task.edit', ['model' => $task, 'categories' => $categories, 'hududs' => $hududs]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'title' => 'required|max:255',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,svg,pdf,docx,xls,xlsx|max:4096',
            'category_id' => 'required',
            'data' => 'required|date',
            'hududs' => 'required|array',
            'hududs.*' => 'exists:hududs,id',
        ]);
        $task = Task::findOrFail($id);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = date('Y-m-d') . '_' . $extension;
            $file->move('files/', $filename);
            $data['file'] = $filename;
        }
        $task->update($data);

        foreach ($request->hududs as $hudud) {
            $task->HududTask()->update([
                'hudud_id' => $hudud,
                'status' => '1'
            ]);
        }
        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request, TaskRegion $task)
    {
        $task->findOrFail($request->id)->task()->delete();
        return redirect()->route('task.index');
    }

    public function status(Request $request, TaskRegion $task)
    {
        $task
            ->where('id', $request->id)
            ->update(['status' => $request->active]);
        return redirect(route('task.index'))->with('update', 'Updated');
    }
}
