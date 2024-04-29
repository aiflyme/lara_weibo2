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

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3 row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email 地址</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">密码</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">确认密码</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Send Email</button>
            </form>

            <hr>

        </div>
    </div>
@endsection
