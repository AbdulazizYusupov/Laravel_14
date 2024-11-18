@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Task add</h1>
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
                        <form action="{{route('task.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="name" class="form-control" placeholder="Enter Task Name"><br>
                            <input type="text" name="title" class="form-control" placeholder="Enter Task Title"><br>
                            <input type="file" name="file" class="form-control"><br>
                            <input type="date" name="data" class="form-control"><br>
                            <label for="category_id">Category</label>
                            <select name="category_id" class="form-select">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select><br>
                            <label for="hududs[]">Hudud</label>
                            <div class="mb-3">
                                <select name="hududs[]" class="select2"
                                        multiple="multiple"
                                        data-placeholder="Select a hudud"
                                        aria-label="Select hududs"
                                        style="width: 100%;">
                                    @foreach ($hududs as $hudud)
                                        <option value="{{ $hudud->id }}">
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

