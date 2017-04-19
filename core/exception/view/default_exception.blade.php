@extends('base_exception')

@section('js')
    <script type="text/javascript" src="{{ asset("javascript/app.js") }}"></script>
@stop

@section('css')
    <link href="{{ asset('css/home.css') }}" type="text/css" rel="stylesheet">
    <style>
        .exception-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .exception-message {
            color: #43c7ff;
        }
    </style>
@stop

@section('content')
    <div class="exception-container">
        <div class="home-banner">
            <img src="{{ image('frame_blue_two_hills_v2.png') }}" class="banner">
            <img src="{{ image('frame_me_blue.png') }}">
        </div>
        <h1 class="header">Oops, looks like something went wrong!</h1>
        <h4 class="exception-message">{{ $exception->getMessage() }}</h4>
    </div>
@stop