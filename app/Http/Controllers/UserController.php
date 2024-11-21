<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Javob;
use App\Models\Task;
use App\Models\TaskRegion;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $id = $user->hudud->id;

        $count = TaskRegion::where('hudud_id', $id)->count();

        $twodays = TaskRegion::where('hudud_id', $id)
            ->whereHas('task', function ($query) {
                $query->whereDate('data', now()->addDays(2));
            })->count();

        $tomorrow = TaskRegion::where('hudud_id', $id)
            ->whereHas('task', function ($query) {
                $query->whereDate('data', now()->addDays(1));
            })->count();

        $today = TaskRegion::where('hudud_id', $id)
            ->whereHas('task', function ($query) {
                $query->whereDate('data', now()->addDays(0));
            })->count();

        $models = TaskRegion::orderBy('id', 'desc')
            ->where('hudud_id', $id)
            ->paginate(10);
        return view('user.index', ['models' => $models, 'count' => $count, 'twodays' => $twodays, 'tomorrow' => $tomorrow, 'today' => $today]);
    }

    public function send(Request $request, $id)
    {
        $data = $request->validate([
            'hudud_id' => 'required',
            'task_id' => 'required',
            'title' => 'required|max:255',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,svg,pdf,docx,xls,xlsx|max:4096',
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = date('d-m-Y-H-i-s') . '_' . $extension;
            $file->move('files/', $filename);
            $data['file'] = $filename;
        }

        Javob::create($data);

        $task = TaskRegion::findOrFail($id);

        if ($task->status !== '3') {
            $task->update([
                'status' => '3',
            ]);
        }
        return redirect()->route('index');
    }

    public function izoh(Request $request, $id)
    {
        $request->validate([
            'izoh' => 'required|max:255',
        ]);

        if ($request->action == 'reject') {
            $data = [
                'izoh' => $request->izoh,
                'status' => '1',
            ];
        } else {
            $data = [
                'izoh' => $request->izoh,
                'status' => '2',
            ];
        }

        $javob = Javob::findOrFail($id);

        $javob->update($data);

        $task = TaskRegion::findOrFail($request->task_id);
        if ($request->action == 'reject') {
            $task->update([
                'status' => '0',
            ]);
        } else {
            $task->update([
                'status' => '4',
            ]);
        }

        return redirect(route('task.index'));
    }

    public function filter(Request $request)
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
        $user = auth()->user();
        $id = $user->hudud->id;

        $start = $request->start_date;
        $end = $request->end_date;

        $models = TaskRegion::whereHas('task', function ($query) use ($start, $end) {
            $query->whereBetween('data', [$start, $end]);
        })
            ->where('hudud_id', $id)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('user.index', ['models' => $models, 'count' => $count, 'twodays' => $twodays, 'tomorrow' => $tomorrow, 'today' => $today]);
    }

}
