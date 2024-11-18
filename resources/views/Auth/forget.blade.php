@extends('layouts.sign')

@section('title' ,'Forget')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">{{ __('Forget password') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('forgetPassword' )}}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" required class="form-control">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-outline-info w-100">Check Email</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
