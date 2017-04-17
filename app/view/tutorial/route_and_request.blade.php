@extends('base')

@section('js')
    <script type="text/javascript" src="{{ asset("javascript/app.js") }}"></script>
@stop

@section('css')
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/themify-icons.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" type="text/css" rel="stylesheet">
@stop

@section('content')

    <div class="navigation-header fade-in fade-out container">
        @include('tutorial.partial.content_banner', ["navigation_left" => "authorization", "navigation_right" => "controller-and-module",])
    </div>

    <div class="tutorial fade-in fade-out container bordered">
        <h1 class="header">Routes and Requests</h1>
        <span>Now that we have setup our database schema for <code>PHP Sentry</code> and defined the necessary parameters for
            connecting to our database, we will next register a <code>Route</code>. In this framework, any functionality begins with
            a <code>Route</code>, it registers an entry point into our framework with a unique <code>URI.</code> Once we have
            registerd a <code>URI</code>, we can couple this to a <code>Controller</code> and a <code>Method</code> within it.
            <code>Routes</code> are registerd in the <code>Routes.php</code> file located in the <strong>app folder</strong> as
            <code>Method</code> calls like the following.
        </span>

        <br>
        <br>
        <span>For the authorization module, we will create 5 <code>Routes</code> and these will be used for displaying the
            <strong>Login</strong> and <strong>Registration</strong> pages and for processing them.
        </span>

        <br>
        <br>
        <code class="editor-title">Routes.php</code>
        <div class="editor-container has-title">
            <pre class="editor config">
&lt;?php

namespace <span class="variable">app</span><span class="bracket">;</span>

use <span class="variable">core</span><span class="bracket">\</span><span class="variable">Router</span><span class="bracket">;</span>

<span class="comment">// Routes for authorization</span>
Router::get("login_page", "/auth/login", "UserController@show_login");
Router::post("auth_login", "/auth/login", "UserController@login");
Router::get("registration_page", "/auth/registration", "UserController@show_registration");
Router::post("auth_registration", "/auth/registration", "UserController@register");
Router::get("auth_logout", "/auth/logout", "UserController@logout");
...
            </pre>
        </div>

        <span>When you register a route, you need to provide atleast 3 parameters. The first parameter is the name of the given route.
            You can later access this route again by this name (for example for generating a <code>URI</code> for this route). The second
            parameter is the <code>URI</code> which is used to match a <code>Route</code> to the current request <code>URI</code>. In this
            <code>URI</code> you can define wildcards of different types. With the third parameter, you can specify the <code>Controller</code>
            and <code>Method</code> that you would like to bind to this <code>Route.</code>
        </span>

        <span>Once the framework matches the current <code>URI</code> to a <code>Route</code> you have defined, it will build a <code>Request object.</code>
            This object holds all information regarding the incomming request from a client. This includes:
        </span>

        <ul class="covered-features">
            <li><span><span class="ti ti-arrow-right"></span>The <code>URI</code></span></li>
            <li><span><span class="ti ti-arrow-right"></span>The <code>HTTP Method</code> used</span></li>
            <li><span><span class="ti ti-arrow-right"></span>All <code>GET and POST</code> variables</span></li>
        </ul>

        <span>Next up we will create a new&nbsp;<code>controller</code>&nbsp;in the&nbsp;<strong>Controller folder</strong>&nbsp;
            located in&nbsp;<code>/app/controller</code>.&nbsp;&nbsp;We will name this new&nbsp;<code>controller</code>&nbsp;
            <span class="ti ti-arrow-right"></span>&nbsp;&nbsp;<code>UserController</code>&nbsp; and we will implement 5 <code>Methods.</code>
        </span>

        <div class="navigation-container bottom">
            <div class="navigation authorization-btn"><span class="navigation-icon ti-arrow-left"></span></div>
            <div class="navigation controller-and-module-btn"><span class="navigation-icon ti-arrow-right"></span></div>
        </div>
    </div>
@stop