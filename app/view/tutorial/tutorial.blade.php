@extends('base')

@section('js')
    <script type="text/javascript" src="{{ asset("javascript/app.js") }}"></script>
@stop

@section('css')
    <link href="{{ asset('css/themify-icons.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" type="text/css" rel="stylesheet">
@stop

@section('content')
    <div class="navigation-header fade-in fade-out container">
        @include('tutorial.partial.content_banner', ["navigation_right" => "authorization",])
    </div>

    <div class="tutorial fade-in fade-out container bordered">
        <span>In this tutorial we are going to setup an authentication module. With this authentication module, users will be able
            to register an account and login. By developing this functionality, we will touch on most of the primary features
            that this framework has to offer. For the authentication feature, we will use <code>PHP Sentry.</code>
        </span>
        <span>The following features of the <code>FrameMe</code> framework will be covered by this tutorial:</span>

        <ul class="covered-features">
            <li><span class="authorization-btn nav-btn"><span class="ti ti-arrow-right"></span><code>Authentication</code></span></li>
            <li><span class="route-and-request-btn nav-btn"><span class="ti ti-arrow-right"></span><code>Router</code>&nbsp;and&nbsp;<code>Request</code></span></li>
            <li><span class="controller-and-module-btn nav-btn"><span class="ti ti-arrow-right"></span><code>Controllers</code>&nbsp;and&nbsp;<code>Modules</code></span></li>
            <li><span class="model-btn nav-btn"><span class="ti ti-arrow-right"></span><code>Models (Data objects)</code> and <code>Model Generator</code></span></li>
            <li><span class="query-builder-btn nav-btn"><span class="ti ti-arrow-right"></span><code>Query Builder (Database Coupling)</code></span></li>
            <li><span class="blade-btn nav-btn"><span class="ti ti-arrow-right"></span><code>Blade (Template Engine)</code></span></li>
        </ul>

        <div class="navigation-container bottom">
            {{--<div class="navigation"><span class="navigation-icon ti-arrow-left"></span></div>--}}
            <div class="navigation authorization-btn"><span class="navigation-icon ti-arrow-right"></span></div>
        </div>
    </div>
@stop