<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStore;
use App\Http\Requests\TaskUpdate;
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
        $count = TaskRegion::all()->count();
        $models = TaskRegion::orderBy('id', 'desc')->paginate(10);
        $twodays = TaskRegion::whereHas('task', function ($query) {
            $query->whereDate('data', now()->addDays(2));
        })->count();
        $tomorrow = TaskRegion::whereHas('task', function ($query) {
            $query->whereDate('data', now()->addDays(1));
        })->count();
        $today = TaskRegion::whereHas('task', function ($query) {
            $query->whereDate('data', now()->addDays(0));
        })->count();
        $confirm = TaskRegion::whereHas('task', function ($query) {
            $query->where('status', 4);
        })->count();
        $reject = TaskRegion::where('status', '!=', 4)->whereHas('task', function ($query) {
            $query->where('data', '<', date('Y-m-d'));
        })->count();
        return view('Task.index', ['models' => $models, 'count' => $count,'twodays' => $twodays,'today' => $today, 'tomorrow' => $tomorrow,'confirm' => $confirm,'reject' => $reject]);
    }
    public function data(int $key)
    {
        $count = TaskRegion::all()->count();
        $twodays = TaskRegion::whereHas('task', function ($query) {
            $query->whereDate('data', now()->addDays(2));
        })->count();
        $tomorrow = TaskRegion::whereHas('task', function ($query) {
            $query->whereDate('data', now()->addDays(1));
        })->count();
        $today = TaskRegion::whereHas('task', function ($query) {
            $query->whereDate('data', now()->addDays(0));
        })->count();
        $confirm = TaskRegion::whereHas('task', function ($query) {
            $query->where('status', 4);
        })->count();
        $reject = TaskRegion::where('status', '!=', 4)->whereHas('task', function ($query) {
            $query->where('data', '<', date('Y-m-d'));
        })->count();
        if ($key == 1) {
            $models = TaskRegion::whereHas('task', function ($query) {
                $query->whereDate('data', now()->addDays(2));
            })->orderBy('id', 'desc')->paginate(10);
        }elseif ($key == 2){
            $models = TaskRegion::whereHas('task', function ($query) {
                $query->whereDate('data', now()->addDays(1));
            })->orderBy('id', 'desc')->paginate(10);
        }elseif ($key == 3){
            $models = TaskRegion::whereHas('task', function ($query) {
                $query->whereDate('data', now()->addDays(0));
            })->orderBy('id', 'desc')->paginate(10);
        }elseif ($key == 4){
            $models = TaskRegion::whereHas('task', function ($query) {
                $query->where('status' , 4);
            })->orderBy('id', 'desc')->paginate(10);
        }elseif ($key == 5){
            $models = TaskRegion::where('status', '!=', 4)->whereHas('task', function ($query) {
                $query->where('data', '<', date('Y-m-d'));
            })->orderBy('id', 'desc')->paginate(10);
        }
        return view('Task.index', ['models' => $models,'count' => $count,'twodays' => $twodays,'today' => $today, 'tomorrow' => $tomorrow,'confirm' => $confirm,'reject' => $reject]);
    }
    public function create()
    {
        $hududs = Hudud::all();
        $categories = Category::all();
        return view('Task.create', ['categories' => $categories, 'hududs' => $hududs]);
    }
    public function store(TaskStore $request)
    {
        $data = $request->validated();

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
                'category_id' => $task->category_id,
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

    public function update(TaskUpdate $request, $id)
    {
        $data = $request->validated();

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
        $count = TaskRegion::all()->count();
        $twodays = TaskRegion::whereHas('task', function ($query) {
            $query->whereDate('data', now()->addDays(2));
        })->count();
        $tomorrow = TaskRegion::whereHas('task', function ($query) {
            $query->whereDate('data', now()->addDays(1));
        })->count();
        $today = TaskRegion::whereHas('task', function ($query) {
            $query->whereDate('data', now()->addDays(0));
        })->count();
        $confirm = TaskRegion::whereHas('task', function ($query) {
            $query->where('status', 4);
        })->count();
        $reject = TaskRegion::where('status', '!=', 4)->whereHas('task', function ($query) {
            $query->where('data', '<', date('Y-m-d'));
        })->count();
        return view('Task.index', ['models' => $models, 'count' => $count, 'twodays' => $twodays, 'today' => $today, 'tomorrow' => $tomorrow, 'confirm' => $confirm, 'reject' => $reject]);
    }

}
