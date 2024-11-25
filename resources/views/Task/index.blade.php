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
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$count}}</h3>
                                <p>All tasks</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{route('task.index')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{$twodays}}</h3>
                                <p>2 kun qolganlar</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{route('task.data', 1)}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{$tomorrow}}</h3>
                                <p>Ertaga</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{route('task.data',2)}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{$today}}</h3>
                                <p>Bugun</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{route('task.data', 3)}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$confirm}}</h3>
                                <p>Tasdiqlanganlar</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{route('task.data', 4)}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{$reject}}</h3>
                                <p>Muddati buzulganlar</p>
                            </div>
                            <div class="icon">
                                <i class="ion-close-circled"></i>
                            </div>
                            <a href="{{route('task.data',5)}}" class="small-box-footer">More info
                                <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6 mt-2">
                        <a href="{{route('task.create')}}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add
                        </a>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-10 mt-2">
                        <form action="{{ route('task.filter') }}" method="POST" class="form-inline">
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
                            <button type="submit" class="btn" style="background-color: #343a40; color: white;">
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
                    <div class="col-12">
                        <table class="table table-striped text-center" style="border: 1px solid #ccc;">
                            <thead>
                            <tr>
                                <th style="border: 1px solid #ccc;">ID</th>
                                <th style="border: 1px solid #ccc;">Hudud</th>
                                <th style="border: 1px solid #ccc;">Name</th>
                                <th style="border: 1px solid #ccc;">Title</th>
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
                                               download="{{ $model->task->file }}" class="btn btn-sm"
                                               style="background-color: #00d1d7; color: white; border: none; padding: 5px 10px; text-align: center; text-decoration: none; display: inline-block; font-size: 14px; border-radius: 4px;">
                                                <i class="fas fa-download"></i> Yuklab olish
                                            </a>
                                        @else
                                            <button class="btn btn-sm"
                                                    style="background-color: #6c757d; color: white; border: none; padding: 5px 10px; text-align: center; text-decoration: none; display: inline-block; font-size: 14px; border-radius: 4px;"
                                                    disabled>
                                                Fayl mavjud emas
                                            </button>
                                        @endif
                                    </td>
                                    <td style="border: 1px solid #ccc;">{{$model->task->category->name}}</td>
                                    <td style="border: 1px solid #ccc;">{{$model->task->data}}</td>
                                    <td style="border: 1px solid #ddd; padding: 8px;">
                                        @if($model->status == 0)
                                            <a href="#"
                                               style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #ff0000; border-radius: 4px; color: #ff0000; cursor: not-allowed;pointer-events: none;"
                                               target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                     fill="none"
                                                     stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span
                                                    style="font-size: 12px; margin-top: 5px;">Qaytarildi</span>
                                            </a>
                                        @endif
                                        @if($model->status == 1 )
                                            <a href="#"
                                               style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #ffd700; border-radius: 4px; color: #ffd700; cursor: not-allowed;pointer-events: none;"
                                               target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                     fill="none"
                                                     stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span
                                                    style="font-size: 12px; margin-top: 5px;">topshirildi</span>
                                            </a>
                                        @endif
                                        @if($model->status == 2)
                                            <a href="#"
                                               style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #007bff; border-radius: 4px; color: #007bff; pointer-events: none;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-check2-all"
                                                     viewBox="0 0 16 16">
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
                                        @if($model->status == 3)
                                            <button type="button" class="btn btn-outline-success"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#{{ $model->id }}"
                                                    style="border: 2px solid #28a745; color: #28a745; background-color: white; padding: 10px 20px; border-radius: 8px; transition: all 0.3s ease;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"/>
                                                </svg>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="{{ $model->id }}" tabindex="-1"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                Check
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label
                                                                class="float-left">Title: {{ $model->task->javob->first()->title }}</label><br><br>
                                                            <label class="float-left">File: </label>
                                                            @if($model->task->javob->first()->file)
                                                                <a class="float-left mt-1"
                                                                   href="{{ asset('files/' . $model->task->javob->first()->file) }}"
                                                                   download="{{ $model->task->javob->first()->file }}"
                                                                   class="btn btn-sm"
                                                                   style="background-color: #00d1d7; color: white; border: none; padding: 8px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 14px; border-radius: 4px; transition: all 0.3s ease;">
                                                                    <i class="fas fa-download"></i> Download
                                                                </a>
                                                            @else
                                                                <span
                                                                    class="text-muted float-left">No file available</span>
                                                            @endif<br><br>
                                                            <form
                                                                action="{{ route('izoh', $model->task->javob->first()->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="task_id"
                                                                       value="{{ $model->id }}">
                                                                <input class="form-control" type="text" name="izoh"
                                                                       placeholder="Comment"
                                                                       style="border-radius: 8px; padding: 10px;"><br>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close
                                                                    </button>
                                                                    <button type="submit" name="action" value="reject"
                                                                            class="btn btn-outline-danger"
                                                                            style="border-radius: 8px; padding: 8px 20px;">
                                                                        Reject
                                                                    </button>
                                                                    <button type="submit" name="action" value="confirm"
                                                                            class="btn btn-outline-primary"
                                                                            style="border-radius: 8px; padding: 8px 20px;">
                                                                        Confirm
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($model->status == 4)
                                            <a href="#"
                                               style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #28a745; border-radius: 4px; color: #28a745; pointer-events: none;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-check2-all"
                                                     viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"/>
                                                    <path
                                                        d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                                                </svg>
                                                <span style="font-size: 12px; margin-top: 5px;">
                                                        tasdiqlangan
                                                    </span>
                                            </a>
                                        @endif
                                    </td>
                                    <td style="border: 1px solid #ccc;"><a
                                            href="{{route('task.edit',$model->id)}}"
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
                                                     fill="currentColor" class="bi bi-trash3"
                                                     viewBox="0 0 16 16">
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

