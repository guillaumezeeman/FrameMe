@extends('base')

@section('js')
    <script type="text/javascript" src="{{ asset("javascript/app.js") }}"></script>
@stop

@section('css')
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/themify-icons.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" type="text/css" rel="stylesheet">
@stop

@section('content')
    <div class="auth-container fade-in">

        <div class="banner-container">
            <img src="{{ image('frame_me_blue.png') }}" class="banner">
            <br>
            <br>
        </div>

        <div class="auth-content">
            <form action="{{ url('auth_login') }}" method="post">
                <div class="form-container">
                    <div class="input-group">
                        <input class="form-control full-width" type="text" name="email" value="" placeholder="E-mail">
                        <div class="icon-container"><span class="ti-user"></span></div>
                    </div>

                    <div class="input-group">
                        <input class="form-control full-width" type="password" name="password" value="" placeholder="Password">
                        <div class="icon-container"><span class="ti-lock"></span></div>
                    </div>

                    <span><a href="{{ url('registration_page') }}">Do not yet have a account, register one here!</a></span>
                </div>
                <div class="button-container">
                    <div class="radio-container">
                        <input id="remember-me" type="checkbox" name="remember_me">
                        <label for="remember-me">Remember me</label>
                    </div>
                    <div class="buttons">
                        <button class="btn">Login</button>
                        {{--<span class="btn">Login</span>--}}
                    </div>
                </div>
            </form>
        </div>

    </div>
@stop