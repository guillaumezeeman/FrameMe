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
        @include('tutorial.partial.content_banner', ["navigation_left" => "tutorial", "navigation_right" => "route-and-request",])
    </div>

    <div class="tutorial fade-in fade-out container bordered">
        <h1 class="header">Authorization</h1>
        <span>The first step of this tutorial is setting up the authorization module <code>PHP Sentry.</code> This library has
            several amazing features of which the documentation you can view
            <a href="https://cartalyst.com/manual/sentry" class="link" target="_blank">here.</a> Before we can implement any
            logic in this framework, we are first going to need to configure our database for the use of <code>PHP Sentry.</code>
            You can find the database schema in the root of the <strong>Project Folder.</strong> This schema is for a
            <code>MySQL</code> database. If you are using a different Database Management System (<code>DBMS</code>), you might
            need to alter the schema.
        </span>

        <div class="center">
            <img src="{{ image('tutorial/sentry_schema.png') }}" class="bordered image-inline">
        </div>

        <span>The database configuration can be stored in the <code>Config.php</code> file located in the <strong>Project
            Root</strong> folder. The following attributes need to be specified before a succesful database connection can
            be established:
        </span>

        <ul class="covered-features">
            <li><span class="ti ti-arrow-right"></span>The Driver (<code>DBMS</code>)</li>
            <li><span class="ti ti-arrow-right"></span>The Host (location of the database specified as a IP-address)</li>
            <li><span class="ti ti-arrow-right"></span>The Database name</li>
            <li><span class="ti ti-arrow-right"></span>The Username</li>
            <li><span class="ti ti-arrow-right"></span>The Password</li>
        </ul>

{{--        <img src="{{ image('tutorial/configure.png') }}" class="bordered image-inline">--}}

        <code class="editor-title">Config.php</code>
        <div class="editor-container has-title">
            <pre class="editor config">
&lt;?php

$base_dir = __DIR__;

return [
    ...
    "database" => [
        "driver"    => "mysql",
        "host"      => "8.8.8.8:3306",
        "database"  => "databae_name",
        "username"  => "database_username",
        "password"  => "some_random_hash",
        "charset"   => "utf8",
        "collation" => "utf8_unicode_ci",
    ],
];
            </pre>
        </div>

        <div class="navigation-container bottom">
            <div class="navigation tutorial-btn"><span class="navigation-icon ti-arrow-left"></span></div>
            <div class="navigation route-and-request-btn"><span class="navigation-icon ti-arrow-right"></span></div>
        </div>
    </div>
@stop