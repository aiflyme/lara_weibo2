@extends('layouts.default')
@section('title', 'update profile')

@section('content')
    <div class="offset-md-2 col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Edit profile</h5>
            </div>
            <div class="card-body">

                @include('shared._errors')

                <div class="gravatar_edit">
                    <a href="http://gravatar.com/emails" target="_blank">
                        <img src="{{ $user->gravatar("200") }}" alt="{{$user->name}}" class="gravatar">
                    </a>
                </div>

                <form method="post" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email:</label>
                        <input type="text" name="email" class="form-control" value="{{$user->email}}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" value="{{old('password')}}">
                    </div>
                    <div class="mb-3">
                        <label for="password">Confirmation Password:</label>
                        <input type="password" name="password_confirmation" class="form-control" value="{{old('password_confirmation')}}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@stop
