@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Task</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$count}}</h3>
                                <p>All tasks</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{route('manage.index')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{$twodays}}</h3>
                                <p>2 kun qolganlar</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{route('manage.filter', ['data', 2])}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{$tomorrow}}</h3>
                                <p>Ertaga</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{route('manage.filter',['data',1])}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{$today}}</h3>
                                <p>Bugun</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{route('manage.filter', ['data',0])}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$confirm}}</h3>
                                <p>Tasdiqlanganlar</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{route('manage.filter', ['status','approved'])}}" class="small-box-footer">More
                                info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{$reject}}</h3>
                                <p>Muddati buzulganlar</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{route('manage.filter', ['data','expired'])}}" class="small-box-footer">More info
                                <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
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
                                <th style="border: 4px solid #ccc;">Hududlar</th>
                                @foreach($categories as $category)
                                    <th style="border: 4px solid #ccc;">{{$category->name}}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($hududs as $hudud)
                                <tr>
                                    <th style="border: 4px solid #ccc;">{{$hudud->name}}</th>
                                    @foreach($categories as $category)
                                        <td style="padding: 10px; border: 1px solid #ddd; vertical-align: middle;">
                                            @if(isset($query) && isset($key))
                                                @if($query == 'data' && $key !='expired')
                                                    @php
                                                        $key = (int)$key;
                                                        $taskCount = $hudud->HududTask()
                                                        ->whereHas('task', function ($q) use ($query, $key) {
                                                            $q->whereDate($query, now()->addDays($key));
                                                        })
                                                        ->where('category_id', $category->id)
                                                        ->count();
                                                    @endphp
                                                @elseif($key == 'expired')
                                                    @php
                                                        $taskCount = $hudud->HududTask()
                                                        ->whereHas('task', function ($q) use ($query) {
                                                            $q->where($query, '<', date('Y-m-d'));
                                                        })
                                                        ->where('category_id', $category->id)
                                                        ->count();
                                                    @endphp
                                                @elseif($key == 'approved')
                                                    @php
                                                        $taskCount = $hudud->HududTask()
                                                       ->whereHas('task', function ($q) use ($query, $key) {
                                                           $q->where('status', '=', 4);
                                                       })
                                                       ->where('category_id', $category->id)
                                                       ->count();
                                                    @endphp
                                                @endif
                                            @else
                                                @php
                                                    $taskCount = $hudud->HududTask->where('category_id',
                                                    $category->id)->count();
                                                @endphp
                                            @endif

                                            @if($taskCount > 0 and isset($key))
                                                @if($key == 'expired')
                                                    <a href="#">
                                                        <span style="display: inline-block; padding: 8px 15px;
                                                                            border-radius: 5px; background-color: red;
                                                                            color: white; font-weight: bold; font-size: 14px;
                                                                            text-align: center; width: 50px; cursor: pointer;">
                                                            {{ $taskCount }}
                                                        </span>
                                                    </a>
                                                @endif
                                                @if($key == 'approved')
                                                    <a href="#">
                                                        <span style="display: inline-block; padding: 8px 15px;
                                                                            border-radius: 5px; background-color: green;
                                                                            color: white; font-weight: bold; font-size: 14px;
                                                                            text-align: center; width: 50px; cursor: pointer;">
                                                            {{ $taskCount }}
                                                        </span>
                                                    </a>
                                                @endif
                                                @if($key == 0)
                                                    <a href="#">
                                                        <span style="display: inline-block; padding: 8px 15px;
                                                                            border-radius: 5px; background-color: yellow;
                                                                            color: white; font-weight: bold; font-size: 14px;
                                                                            text-align: center; width: 50px; cursor: pointer;">
                                                            {{ $taskCount }}
                                                        </span>
                                                    </a>
                                                @endif
                                                @if($key == 1)
                                                    <a href="#">
                                                        <span style="display: inline-block; padding: 8px 15px;
                                                                            border-radius: 5px; background-color: blue;
                                                                            color: white; font-weight: bold; font-size: 14px;
                                                                            text-align: center; width: 50px; cursor: pointer;">
                                                            {{ $taskCount }}
                                                        </span>
                                                    </a>
                                                @endif
                                                @if($key == 2)
                                                    <a href="#">
                                                        <span style="display: inline-block; padding: 8px 15px;
                                                                            border-radius: 5px; background-color: grey;
                                                                            color: white; font-weight: bold; font-size: 14px;
                                                                            text-align: center; width: 50px; cursor: pointer;">
                                                            {{ $taskCount }}
                                                        </span>
                                                    </a>
                                                @endif
                                            @endif
                                            @if(!isset($key) and $taskCount > 0)
                                                <a href="#">
                                                    <span style="display: inline-block; padding: 8px 15px;
                                                                        border-radius: 5px; background-color: #02c0c9;
                                                                        color: white; font-weight: bold; font-size: 14px;
                                                                        text-align: center; width: 50px; cursor: pointer;">
                                                            {{ $taskCount }}
                                                    </span>
                                                </a>
                                            @endif
                                        </td>
                                    @endforeach
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

