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
    public function index()
    {
        $models = TaskRegion::orderBy('id', 'desc')->paginate(10);
        return view('Task.index', ['models' => $models]);
    }
    public function create()
    {
        $hududs = Hudud::all();
        $categories = Category::all();
        return view('Task.create', ['categories' => $categories, 'hududs' => $hududs]);
    }
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
            $filename = date('d-m-Y-H-i-s') . '_' . $extension;
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
    public function edit(TaskRegion $task)
    {
        $hududs = Hudud::all();
        $categories = Category::all();
        return view('Task.edit', ['model' => $task, 'categories' => $categories, 'hududs' => $hududs]);
    }

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
        return redirect()->back()->with('update', 'Updated');
    }

    public function filter(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        $models = TaskRegion::whereHas('task', function ($query) use ($start, $end) {
            $query->whereBetween('data', [$start, $end]);
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('Task.index', ['models' => $models]);
    }

}
