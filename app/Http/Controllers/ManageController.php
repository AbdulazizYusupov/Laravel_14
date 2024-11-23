<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Hudud;
use App\Models\Task;
use App\Models\TaskRegion;
use Illuminate\Http\Request;

class ManageController extends Controller
{
    public function index()
    {
        $count = TaskRegion::all()->count();
        $categories = Category::all();
        $hududlar = Hudud::all();
        $twodays = TaskRegion::where('status', '!=', 4)->whereHas('task', function ($query) {
            $query->whereDate('data', now()->addDays(2));
        })->count();
        $tomorrow = TaskRegion::where('status', '!=', 4)->whereHas('task', function ($query) {
            $query->whereDate('data', now()->addDays(1));
        })->count();
        $today = TaskRegion::where('status', '!=', 4)->whereHas('task', function ($query) {
            $query->whereDate('data', now()->addDays(0));
        })->count();
        $confirm = TaskRegion::whereHas('task', function ($query) {
            $query->where('status', 4);
        })->count();
        $reject = TaskRegion::where('status', '!=', 4)->whereHas('task', function ($query) {
            $query->where('data', '<', date('Y-m-d'));
        })->count();
        return view('manage.index', ['hududs' => $hududlar, 'categories' => $categories, 'count' => $count, 'twodays' => $twodays, 'today' => $today, 'tomorrow' => $tomorrow, 'confirm' => $confirm, 'reject' => $reject]);
    }

    public function filter($query, $key)
    {
        $count = TaskRegion::all()->count();
        $categories = Category::all();
        $hududlar = Hudud::all();
        $twodays = TaskRegion::where('status', '!=', 4)->whereHas('task', function ($query) {
            $query->whereDate('data', now()->addDays(2));
        })->count();
        $tomorrow = TaskRegion::where('status', '!=', 4)->whereHas('task', function ($query) {
            $query->whereDate('data', now()->addDays(1));
        })->count();
        $today = TaskRegion::where('status', '!=', 4)->whereHas('task', function ($query) {
            $query->whereDate('data', now()->addDays(0));
        })->count();
        $confirm = TaskRegion::whereHas('task', function ($query) {
            $query->where('status', 4);
        })->count();
        $reject = TaskRegion::where('status', '!=', 4)->whereHas('task', function ($query) {
            $query->where('data', '<', date('Y-m-d'));
        })->count();
        return view('manage.index', ['query' => $query, 'key' => $key, 'hududs' => $hududlar, 'categories' => $categories, 'count' => $count, 'twodays' => $twodays, 'today' => $today, 'tomorrow' => $tomorrow, 'confirm' => $confirm, 'reject' => $reject]);
    }

    public function show(Request $request)
    {
        $hududId = $request->input('hudud_id');
        $categoryId = $request->input('category_id');
        $key = $request->input('key');

        $tasksQuery = TaskRegion::where('hudud_id', $hududId)
            ->where('category_id', $categoryId);

        if ($key !== null) {
            if (is_numeric($key)) {
                $days = (int)$key;
                $tasksQuery->whereHas('task', function ($query) use ($days) {
                    $query->whereDate('data', now()->addDays($days));
                });
            } elseif ($key === 'expired') {
                $tasksQuery->whereHas('task', function ($query) {
                    $query->where('data', '<', now());
                });
            } elseif ($key === 'approved') {
                $tasksQuery->whereHas('task', function ($query) {
                    $query->where('status', '=', 4);
                });
            }
        }

        $tasks = $tasksQuery->get();

        return view('manage.show', compact('tasks'));
    }

    public function info()
    {
        $categories = Category::all();
        return view('manage.info', ['categories' => $categories]);
    }

    public function infoFilter(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        $categories = Category::with(['HududTask' => function ($query) use ($start, $end) {
            $query->whereHas('task', function ($query) use ($start, $end) {
                $query->whereBetween('data', [$start, $end]);
            });
        }])->get();

        return view('manage.info', ['categories' => $categories]);
    }
    public function report()
    {
        $categories = Category::all();
        $hududs = Hudud::all();
        return view('manage.report',['categories'=>$categories,'hududs'=>$hududs]);
    }
}
