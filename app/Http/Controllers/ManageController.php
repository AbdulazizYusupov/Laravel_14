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
        $reject = TaskRegion::whereHas('task', function ($query) {
            $query->where('data', '<', date('Y-m-d'))
            ->where('status', 1);
        })->count();
        return view('manage.index', ['hududs' => $hududlar, 'categories' => $categories, 'count' => $count, 'twodays' => $twodays, 'today' => $today, 'tomorrow' => $tomorrow, 'confirm' => $confirm, 'reject' => $reject]);
    }

    public function filter($query, $key)
    {
        $count = TaskRegion::all()->count();
        $categories = Category::all();
        $hududlar = Hudud::all();
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
        $reject = TaskRegion::whereHas('task', function ($query) {
            $query->where('data', '<', date('Y-m-d'))
            ->where('status', 1);
        })->count();
        return view('manage.index', ['query' => $query, 'key' => $key, 'hududs' => $hududlar, 'categories' => $categories, 'count' => $count, 'twodays' => $twodays, 'today' => $today, 'tomorrow' => $tomorrow, 'confirm' => $confirm, 'reject' => $reject]);
    }
    public function show(Request $request)
    {
        $hududId = $request->input('hudud_id');
        $categoryId = $request->input('category_id');
        $key = $request->input('key');

        $tasks = TaskRegion::where('hudud_id', $hududId)
            ->where('category_id', $categoryId);

        if ($key == 'expired') {
            $tasks->whereHas('task', function ($q) {
                $q->where('data', '<', now());
            });
        } elseif ($key == 'approved') {
            $tasks->whereHas('task', function ($q) {
                $q->where('status', '=', 4);
            });
        }

        $tasks = $tasks->get();

        return view('manage.show', compact('tasks'));
    }
}
