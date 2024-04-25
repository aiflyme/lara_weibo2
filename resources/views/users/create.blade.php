@extends('layouts.default')
@section('title', 'register')

@section('content')
    <div class="offset-md-2 col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Register</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('users.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" value="{{old('name')}}">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email:</label>
                        <input type="text" name="email" class="form-control" value="{{old('email')}}">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" value="{{old('password')}}">
                    </div>
                    <div class="mb-3">
                        <label for="password">Confirmation Password:</label>
                        <input type="password" name="password_confirmation" class="form-control" value="{{old('password_confirmation')}}">
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
@stop
