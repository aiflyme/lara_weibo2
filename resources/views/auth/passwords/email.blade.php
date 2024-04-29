@extends('layouts.default')
@section('title', 'reset password')

@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card-header">
            <h5>reset password</h5>
        </div>
        <div class="card-body">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>

            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-3{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control" value="{{old('email')}}" required>
                </div>

                <button type="submit" class="btn btn-primary">Send Email</button>
            </form>

            <hr>

        </div>
    </div>
@endsection
