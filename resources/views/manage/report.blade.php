@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Hisobotlar</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered text-center table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th>№</th>
                                <th>Hududlar</th>
                                <th>Status</th>
                                @foreach($hududs as $hudud)
                                    <th style="writing-mode: vertical-rl; transform: rotate(180deg);">
                                        {{$hudud->name}}
                                    </th>
                                @endforeach
                                <th>Jami</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th>{{$category->id}}</th>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        <table class="table table-borderless">
                                            <tr><td>Tasdiqlangan</td></tr>
                                            <tr><td>Jarayonda</td></tr>
                                            <tr><td>Ko'rilgan</td></tr>
                                            <tr><td>Berilgan</td></tr>
                                            <tr><td>Qaytarilgan</td></tr>
                                            <tr><td>Muddat buzilgan</td></tr>
                                        </table>
                                    </td>
                                    @foreach($hududs as $hudud)
                                        <td>
                                            <table class="table table-borderless">
                                                @foreach([4 => 'success', 3 => 'primary', 2 => 'warning', 1 => 'info', 0 => 'secondary'] as $status => $color)
                                                    <tr>
                                                        <td>
                                                            <button class="btn btn-{{$color}} btn-sm">
                                                                {{$category->HududTask->where('hudud_id', $hudud->id)->where('status', $status)->count()}}
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm">
                                                            {{$category->HududTask->where('hudud_id', $hudud->id)->where('data', '<', date('Y-m-d'))->where('status','!=',4)->count()}}
                                                        </button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    @endforeach
                                    <td>
                                        <table class="table table-borderless">
                                            @foreach([4 => 'success', 3 => 'primary', 2 => 'warning', 1 => 'info', 0 => 'secondary'] as $status => $color)
                                                <tr>
                                                    <td>
                                                        <button class="btn btn-{{$color}} btn-sm">
                                                            {{$category->HududTask->where('status', $status)->count()}}
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td>
                                                    <button class="btn btn-danger btn-sm">
                                                        {{$category->HududTask->where('data', '<', date('Y-m-d'))->where('status','!=',4)->count()}}
                                                    </button>
                                                </td>
                                            </tr>
                                        </table>
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
