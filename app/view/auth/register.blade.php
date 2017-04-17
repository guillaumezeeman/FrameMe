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
            <form action="{{ url('auth_registration') }}" method="post">
                <div class="form-container">
                    <div class="input-group">
                        <input class="form-control full-width" type="email" name="email" value="" placeholder="E-mail">
                        <div class="icon-container"><span class="ti-user"></span></div>
                    </div>

                    <div class="input-group">
                        <input class="form-control full-width" type="text" name="first_name" value="" placeholder="First name">
                        <div class="icon-container"><span class="ti-id-badge"></span></div>
                    </div>

                    <div class="input-group">
                        <input class="form-control full-width" type="text" name="last_name" value="" placeholder="Last name">
                        <div class="icon-container"><span class="ti-id-badge"></span></div>
                    </div>

                    <div class="input-group">
                        <input class="form-control full-width" type="password" name="password" value="" placeholder="Password">
                        <div class="icon-container"><span class="ti-lock"></span></div>
                    </div>

                    <div class="input-group">
                        <input class="form-control full-width" type="password" name="password_confirm" value="" placeholder="Confirm password">
                        <div class="icon-container"><span class="ti-lock"></span></div>
                    </div>
                </div>
                <div class="button-container">
                    <div class="radio-container">
                        <input id="remember-me" type="checkbox" name="remember_me">
                        <label for="remember-me">Remember me</label>
                    </div>
                    <div class="buttons">
                        <button class="btn">Login</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@stop