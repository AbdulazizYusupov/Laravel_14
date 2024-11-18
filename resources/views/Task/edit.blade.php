@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Task edit</h1>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-2">
                        <a href="{{route('task.index')}}" class="btn btn-primary">Task</a>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <form action="{{route('task.update', $model->task->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" class="form-control" value="{{$model->task->name}}"
                                   placeholder="Enter Task Name"><br>
                            <input type="text" name="title" class="form-control" value="{{$model->task->title}}"
                                   placeholder="Enter Task Title"><br>
                            <input type="file" name="file" class="form-control"><br>
                            <input type="date" name="data" class="form-control" value="{{$model->task->data}}"><br>
                            <label for="category_id">Category</label>
                            <select name="category_id" class="form-select">
                                @foreach($categories as $category)
                                    @if($category->id == $model->task->category_id)
                                        <option selected value="{{$category->id}}">{{$category->name}}</option>
                                    @endif
                                    @if($category->id != $model->task->category_id)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif
                                @endforeach
                            </select><br>
                            <label for="hududs[]">Hudud</label>
                            <div class="form-group">
                                <select name="hududs[]" class="select2"
                                        multiple="multiple"
                                        data-placeholder="Select a Hudud"
                                        aria-label="Select hududs"
                                        style="width: 100%;">
                                    @foreach ($hududs as $hudud)
                                        <option value="{{ $hudud->id }}"
                                                @if (in_array($hudud->id, $model->hudud()->pluck('id')->toArray())) selected @endif>
                                            {{ $hudud->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Add">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

