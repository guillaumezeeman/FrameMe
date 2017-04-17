@extends('base')

@section('js')
    <script type="text/javascript" src="{{ asset("javascript/app.js") }}"></script>
@stop

@section('css')
    <link href="{{ asset('css/home.css') }}" type="text/css" rel="stylesheet">
@stop

@section('content')
    <div class="tutorial fade-out">
        <div class="home-banner">
            <img src="{{ image('frame_blue_two_hills_v2.png') }}" class="banner">
            <img src="{{ image('frame_me_blue.png') }}">
        </div>
        <h1 class="header">Let's get started, shall we <i class="tutorial-btn fa fa-play animate"></i></h1>
    </div>
@stop