@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Update Profile</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 ">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('profile.update',$user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                               value="{{ $user->name }}"><br>
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                               value="{{ $user->email }}"><br>
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password"><br>
                                        <input type="submit" class="btn btn-info" value="Update">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
