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
                        <table class="table table-bordered text-center"
                               style="width: 100%; border-collapse: collapse;">
                            <thead>
                            <tr style="border: 2px solid black">
                                <th rowspan="2" style="width: 40px; height: 100px; border: 2px solid black">№</th>
                                <th rowspan="2" style="width: 160px; border: 2px solid black">Hududlar</th>
                                <th rowspan="2" style="width: 200px; border: 2px solid black">Status</th>
                                @foreach($hududs as $hudud)
                                    <th style="writing-mode: vertical-rl; border: 2px solid black; text-align: center; transform: rotate(180deg); vertical-align: middle; white-space: nowrap; padding: 10px;">
                                        {{$hudud->name}}
                                    </th>
                                @endforeach
                                <th style="border: 2px solid black" rowspan="2">
                                    Jami
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr style="border: 2px solid black">
                                    <th style="border: 2px solid black" rowspan="6">{{$category->id}}</th>
                                    <td style="border: 2px solid black" rowspan="6">{{$category->name}}</td>
                                    <td style="border: 2px solid black">Tasdiqlangan</td>
                                    @foreach($hududs as $hudud)
                                        <td style="border: 2px solid black">
                                            <button class="btn btn-success btn-sm">
                                                {{$category->HududTask->where('hudud_id', $hudud->id)->where('status', 4)->count()}}
                                            </button>
                                        </td>
                                    @endforeach
                                    <td style="border: 2px solid black">
                                        <button class="btn btn-success btn-sm">
                                            {{$category->HududTask->where('status', 4)->count()}}
                                        </button>
                                    </td>
                                </tr>
                                <tr style="border: 2px solid black">
                                    <td style="border: 2px solid black">Jarayonda</td>
                                    @foreach($hududs as $hudud)
                                        <td style="border: 2px solid black">
                                            <button class="btn btn-primary btn-sm">
                                                {{$category->HududTask->where('hudud_id', $hudud->id)->where('status', 3)->count()}}
                                            </button>
                                        </td>
                                    @endforeach
                                    <td style="border: 2px solid black">
                                        <button class="btn btn-primary btn-sm">
                                            {{$category->HududTask->where('status', 3)->count()}}
                                        </button>
                                    </td>
                                </tr>
                                <tr style="border: 2px solid black">
                                    <td style="border: 2px solid black">Ko'rilgan</td>
                                    @foreach($hududs as $hudud)
                                        <td style="border: 2px solid black">
                                            <button class="btn btn-warning btn-sm">
                                                {{$category->HududTask->where('hudud_id', $hudud->id)->where('status', 2)->count()}}
                                            </button>
                                        </td>
                                    @endforeach
                                    <td style="border: 2px solid black;">
                                        <button class="btn btn-warning btn-sm">
                                            {{$category->HududTask->where('status', 2)->count()}}
                                        </button>
                                    </td>
                                </tr>
                                <tr style="border: 2px solid black">
                                    <td style="border: 2px solid black">Berilgan</td>
                                    @foreach($hududs as $hudud)
                                        <td style="border: 2px solid black;">
                                            <button class="btn btn-info btn-sm">
                                                {{$category->HududTask->where('hudud_id', $hudud->id)->where('status', 1)->count()}}
                                            </button>
                                        </td>
                                    @endforeach
                                    <td style="border: 2px solid black">
                                        <button class="btn btn-info btn-sm">
                                            {{$category->HududTask->where('status', 1)->count()}}
                                        </button>
                                    </td>
                                </tr>
                                <tr style="border: 2px solid black">
                                    <td style="border: 2px solid black">Qaytarilgan</td>
                                    @foreach($hududs as $hudud)
                                        <td style="border: 2px solid black">
                                            <button class="btn btn-secondary btn-sm">
                                                {{$category->HududTask->where('hudud_id', $hudud->id)->where('status', 0)->count()}}
                                            </button>
                                        </td>
                                    @endforeach
                                    <td style="border: 2px solid black">
                                        <button class="btn btn-secondary btn-sm">
                                            {{$category->HududTask->where('status', 0)->count()}}
                                        </button>
                                    </td>
                                </tr>
                                <tr style="border: 2px solid black">
                                    <td style="border: 2px solid black">Muddat buzilgan</td>
                                    @foreach($hududs as $hudud)
                                        <td style="border: 2px solid black">
                                            <button class="btn btn-danger btn-sm">
                                                {{$category->HududTask->where('hudud_id', $hudud->id)->where('data', '<', date('Y-m-d'))->where('status','!=',4)->count()}}
                                            </button>
                                        </td>
                                    @endforeach
                                    <td>
                                        <button class="btn btn-danger btn-sm">
                                            {{$category->HududTask->where('data', '<', date('Y-m-d'))->where('status','!=',4)->count()}}
                                        </button>
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
