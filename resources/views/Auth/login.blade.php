@extends('layouts.sign')

@section('title' ,'Login Page')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">{{ __('Login') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('login')}}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" required class="form-control">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" required class="form-control">
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-outline-info w-100">Login</button>
                                <label class="mt-3"><strong>Forgot Password ? </strong></label>
                                <a href="{{route('forget')}}">Click Here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
