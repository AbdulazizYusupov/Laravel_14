@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                @if (session('create'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('create') }}
                    </div>
                @endif
                @if (session('delete'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('delete') }}
                    </div>
                @endif
                @if (session('update'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{ session('update') }}
                    </div>
                @endif
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Task</h1>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6 mt-2">
                        <a href="{{route('task.create')}}" class="btn btn-primary">Create</a>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped text-center" style="border: 1px solid #ccc;">
                            <thead>
                            <tr>
                                <th style="border: 1px solid #ccc;">ID</th>
                                <th style="border: 1px solid #ccc;">Hudud</th>
                                <th style="border: 1px solid #ccc;">Name</th>
                                <th style="border: 1px solid #ccc;">TItle</th>
                                <th style="border: 1px solid #ccc;">File</th>
                                <th style="border: 1px solid #ccc;">Category</th>
                                <th style="border: 1px solid #ccc;">Muddati</th>
                                <th style="border: 1px solid #ccc;">Status</th>
                                <th style="border: 1px solid #ccc;">Update</th>
                                <th style="border: 1px solid #ccc;">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($models as $model)
                                <tr>
                                    <th style="border: 1px solid #ccc;">{{ $model->id }}</th>
                                    <td style="border: 1px solid #ccc;">{{ $model->hudud->name }}</td>
                                    <td style="border: 1px solid #ccc;">{{ $model->task->name }}</td>
                                    <td style="border: 1px solid #ccc;">{{$model->task->title}}</td>
                                    <td style="border: 1px solid #ccc;">
                                        @if($model->task->file)
                                            <a href="{{ asset('files/' . $model->task->file) }}"
                                               download="{{ $model->task->file }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-download"></i> Yuklab olish
                                            </a>
                                        @else
                                            <span class="text-muted">Fayl mavjud emas</span>
                                        @endif
                                    </td>
                                    <td style="border: 1px solid #ccc;">{{$model->task->category->name}}</td>
                                    <td style="border: 1px solid #ccc;">{{$model->task->data}}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        @if($model->status == 1 )

                                            <a href="#"
                                               style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #ff0000; border-radius: 4px; color: #ff0000; cursor: not-allowed;pointer-events: none;"
                                               target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                     fill="none"
                                                     stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span style="font-size: 12px; margin-top: 5px;">topshirildi</span>
                                            </a>
                                        @endif
                                        @if($model->status == 2)
                                            <a href="#"
                                               style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #007bff; border-radius: 4px; color: #007bff; pointer-events: none;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"/>
                                                    <path
                                                        d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                                                </svg>
                                                <span style="font-size: 12px; margin-top: 5px;">

                                                ochilgan
                                            </span>
                                            </a>
                                        @endif
                                    </td>
                                    <td style="border: 1px solid #ccc;"><a href="{{route('task.edit',$model->id)}}"
                                                                           class="btn btn-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                            </svg>
                                        </a></td>
                                    <td style="border: 1px solid #ccc;">
                                        <form action="{{route('task.delete', $model->id)}}" method="get">
                                            @csrf
                                            <button class="btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="col">
                            <div class="me-3">
                                {{ $models->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

