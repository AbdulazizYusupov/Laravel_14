@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tasks</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-6">
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
                    <div class="col-lg-3 col-6">
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
                    <div class="col-lg-3 col-6">
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
                    <div class="col-lg-3 col-6">
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
{{--                    <div class="col-lg-2 col-6">--}}
{{--                        <div class="small-box bg-success">--}}
{{--                            <div class="inner">--}}
{{--                                <h3>{{$confirm}}</h3>--}}
{{--                                <p>Tasdiqlanganlar</p>--}}
{{--                            </div>--}}
{{--                            <div class="icon">--}}
{{--                                <i class="ion ion-pie-graph"></i>--}}
{{--                            </div>--}}
{{--                            <a href="{{route('task.data', 4)}}" class="small-box-footer">More info <i--}}
{{--                                    class="fas fa-arrow-circle-right"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-2 col-6">--}}
{{--                        <div class="small-box bg-danger">--}}
{{--                            <div class="inner">--}}
{{--                                <h3>{{$reject}}</h3>--}}
{{--                                <p>Qaytarilganlar</p>--}}
{{--                            </div>--}}
{{--                            <div class="icon">--}}
{{--                                <i class="ion ion-pie-graph"></i>--}}
{{--                            </div>--}}
{{--                            <a href="{{route('task.data', 5)}}" class="small-box-footer">More info <i--}}
{{--                                    class="fas fa-arrow-circle-right"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6 mt-2">
                        <form action="{{ route('filter') }}" method="POST" class="form-inline">
                            @csrf
                            <div class="form-group mr-2">
                                <label for="start_date">Start Date:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control ml-2">
                            </div>
                            <div class="form-group mr-2">
                                <label for="end_date">End Date:</label>
                                <input type="date" id="end_date" name="end_date" class="form-control ml-2">
                            </div>
                            <button type="submit" class="btn btn-primary">Filter</button>
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
                                <th style="border: 1px solid #ccc;">Name</th>
                                <th style="border: 1px solid #ccc;">Title</th>
                                <th style="border: 1px solid #ccc;">File</th>
                                <th style="border: 1px solid #ccc;">Category</th>
                                <th style="border: 1px solid #ccc;">Sent data</th>
                                <th style="border: 1px solid #ccc;">Deadline</th>
                                <th style="border: 1px solid #ccc;">Izoh</th>
                                <th style="border: 1px solid #ccc;">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($models as $model)
                                <tr>
                                    <th style="border: 1px solid #ccc;">{{ $model->id }}</th>
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
                                            <button class="btn btn-sm btn-secondary"
                                                    style="background-color: #6c757d; color: white; border: none; padding: 5px 10px; text-align: center; text-decoration: none; display: inline-block; font-size: 14px; border-radius: 4px;"
                                                    disabled>
                                                <i class="fas fa-exclamation-circle"></i> Fayl mavjud emas
                                            </button>
                                        @endif
                                    </td>
                                    <td style="border: 1px solid #ccc;">{{$model->task->category->name}}</td>
                                    <td style="border: 1px solid #ccc;">{{$model->task->created_at}}</td>
                                    <td style="border: 1px solid #ccc;">{{$model->task->data}}</td>
                                    <td style="border: 1px solid #ccc;">
                                        @php
                                            $javob = $model->task->javob->first();
                                        @endphp
                                        @if ($javob && $javob->izoh != null)
                                            <output>{{ $javob->izoh }}</output>
                                        @endif
                                    </td>
                                    <td>
                                        @if($model->status == 0)
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#{{ $model->id }}">Rejected
                                            </button>

                                            <div class="modal fade" id="{{ $model->id }}" tabindex="-1"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                Answer
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('send', $model->id) }}" method="POST"
                                                              enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <input type="hidden" name="hudud_id"
                                                                       value="{{ $model->hudud->id }}">
                                                                <input type="hidden" name="task_id"
                                                                       value="{{ $model->task->id }}">
                                                                <input class="form-control" type="text"
                                                                       name="title" placeholder="Title"><br>
                                                                <input class="form-control" type="file" name="file"><br>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">Send
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($model->status == 1)
                                            <form action="{{ route('task.status') }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="id" value="{{ $model->id }}">
                                                <input type="hidden" name="active" value="2">
                                                <button type="submit" class="btn btn-outline-info">Accept</button>
                                            </form>
                                        @endif
                                        @if ($model->status == 2)
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#{{ $model->id }}">Accept
                                            </button>

                                            <div class="modal fade" id="{{ $model->id }}" tabindex="-1"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                Answer
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('send', $model->id) }}" method="POST"
                                                              enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <input type="hidden" name="hudud_id"
                                                                       value="{{ $model->hudud->id }}">
                                                                <input type="hidden" name="task_id"
                                                                       value="{{ $model->task->id }}">
                                                                <input class="form-control" type="text"
                                                                       name="title"><br>
                                                                <input class="form-control" type="file" name="file"><br>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">Send
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if($model->status == 3)
                                            <button type="button" class="btn btn-success">Sent
                                            </button>
                                        @endif
                                        @if($model->status == 4)
                                            <button type="button" class="btn btn-primary">End
                                            </button>
                                        @endif
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


