@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Show more</h1>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ route('manage.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 ">
                        <div class="card">
                            <div class="card-body">
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <th style="border: 1px solid #ccc;">{{ $task->id }}</th>
                                            <td style="border: 1px solid #ccc;">{{ $task->hudud->name }}</td>
                                            <td style="border: 1px solid #ccc;">{{ $task->task->name }}</td>
                                            <td style="border: 1px solid #ccc;">{{$task->task->title}}</td>
                                            <td style="border: 1px solid #ccc;">
                                                @if($task->task->file)
                                                    <a href="{{ asset('files/' . $task->task->file) }}"
                                                       download="{{ $task->task->file }}" class="btn btn-sm"
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
                                            <td style="border: 1px solid #ccc;">{{$task->task->category->name}}</td>
                                            <td style="border: 1px solid #ccc;">{{$task->task->data}}</td>
                                            <td style="border: 1px solid #ddd; padding: 8px;">
                                                @if($task->task->data < date('Y-m-d'))
                                                    <a href="#"
                                                       style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #ff0000; border-radius: 4px; color: #ff0000; cursor: not-allowed;pointer-events: none;"
                                                       target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                             fill="none"
                                                             stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                            <path d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                        <span
                                                            style="font-size: 12px; margin-top: 5px;">Muddati tugagan</span>
                                                    </a>
                                                @endif
                                                @if($task->task->data >= date('Y-m-d'))

                                                    @if($task->status == 0)
                                                        <a href="#"
                                                           style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #ff0000; border-radius: 4px; color: #ff0000; cursor: not-allowed;pointer-events: none;"
                                                           target="_blank">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                 height="20"
                                                                 fill="none"
                                                                 stroke="currentColor" stroke-width="2"
                                                                 viewBox="0 0 24 24">
                                                                <path d="M5 13l4 4L19 7"/>
                                                            </svg>
                                                            <span
                                                                style="font-size: 12px; margin-top: 5px;">Qaytarilgan</span>
                                                        </a>
                                                    @endif
                                                    @if($task->status == 1 )
                                                        <a href="#"
                                                           style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #ffd700; border-radius: 4px; color: #ffd700; cursor: not-allowed;pointer-events: none;"
                                                           target="_blank">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                 height="20"
                                                                 fill="none"
                                                                 stroke="currentColor" stroke-width="2"
                                                                 viewBox="0 0 24 24">
                                                                <path d="M5 13l4 4L19 7"/>
                                                            </svg>
                                                            <span
                                                                style="font-size: 12px; margin-top: 5px;">Topshirilgan</span>
                                                        </a>
                                                    @endif
                                                    @if($task->status == 2)
                                                        <a href="#"
                                                           style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #007bff; border-radius: 4px; color: #007bff; pointer-events: none;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                 height="16"
                                                                 fill="currentColor" class="bi bi-check2-all"
                                                                 viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"/>
                                                                <path
                                                                    d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                                                            </svg>
                                                            <span style="font-size: 12px; margin-top: 5px;">
                                                            Ochilgan
                                                        </span>
                                                        </a>
                                                    @endif
                                                    @if ($task->status == 4)
                                                        <a href="#"
                                                           style="text-decoration: none; display: inline-flex; flex-direction: column; align-items: center; justify-content: center; width: 80px; height: 50px; border: 2px solid #28a745; border-radius: 4px; color: #28a745; pointer-events: none;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                 height="16"
                                                                 fill="currentColor" class="bi bi-check2-all"
                                                                 viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"/>
                                                                <path
                                                                    d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                                                            </svg>
                                                            <span style="font-size: 12px; margin-top: 5px;">
                                                        Tasdiqlangan
                                                    </span>
                                                        </a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
