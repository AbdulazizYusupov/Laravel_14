@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Statistics</h1>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-10 mt-2">
                        <form action="{{ route('info.filter') }}" method="POST" class="form-inline">
                            @csrf
                            <div class="form-group mr-4">
                                <label for="start_date">Start Date:</label>
                                <input type="date" id="start_date" name="start_date"
                                       class="form-control date-input ml-2">
                            </div>
                            <div class="form-group mr-4">
                                <label for="end_date">End Date:</label>
                                <input type="date" id="end_date" name="end_date"
                                       class="form-control date-input ml-2">
                            </div>
                            <button type="submit" class="btn" style="background-color: deepskyblue; color: white;">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered text-center">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Umumiy</th>
                                <th>Tasdiqlangan</th>
                                <th>Jarayonda</th>
                                <th>Ko'rilgan</th>
                                <th>Berilgan</th>
                                <th>Qaytarilgan</th>
                                <th>Muddat buzilgan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <th>{{ $category->id }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->HududTask->count() }}</td>
                                    <td>{{ $category->HududTask->where('status', 4)->count() }}</td>
                                    <td>{{ $category->HududTask->where('status', 3)->count() }}</td>
                                    <td>{{ $category->HududTask->where('status', 2)->count() }}</td>
                                    <td>{{ $category->HududTask->where('status', 1)->count() }}</td>
                                    <td>{{ $category->HududTask->where('status', 0)->count() }}</td>
                                    <td>
                                        @php
                                            $expired = $category->HududTask
                                                ->where('status', '!=', 4)
                                                ->filter(function ($task) {
                                                    return $task->task && $task->task->data < now();
                                                })
                                                ->count();
                                        @endphp
                                        {{ $expired }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
