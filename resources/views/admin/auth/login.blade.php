@extends('layouts.auth.admin')

@section('content')
    {{ Form::open(['method' => 'post', 'class' => 'form-horizontal']) }}

    <div class="login-logo">
        <img src="{{ asset('icons/logo.png') }}">
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <input placeholder="Email" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
               required
               autofocus>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <input placeholder="Password" id="password" type="password" class="form-control" name="password" required>

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>


    <div>
        <button class="btn btn-default submit" type="submiy">Log in</button>
        {{--<a class="reset_pass" href="{{ url('/password/reset') }}">Lost your password?</a>--}}
    </div>

    <div class="clearfix"></div>

    <div class="separator">

        <div>
            <h1>Tender System panel</h1>
            <p>©2016 All Rights Reserved. Tender</p>
        </div>
    </div>
    {{ Form::close() }}
@endsection
