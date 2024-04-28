@extends('layouts.default')
@section('title', 'login')

@section('content')
    <div class="offset-md-2 col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Login</h5>
            </div>
            <div class="card-body">
                @include('shared._errors')

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email">Email:</label>
                        <input type="text" name="email" class="form-control" value="{{old('email')}}">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" value="{{old('password')}}">
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck">
                            <label class="form-check-label" for="exampleCheck">Remember me</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>
                </form>

                <hr>

                <p>No Account? <a href="{{ route('signup') }}">Register now!</a> </p>
            </div>
        </div>
    </div>
@endsection
