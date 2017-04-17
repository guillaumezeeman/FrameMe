@extends('base')

@section('css')
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/themify-icons.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/use_case.css') }}" type="text/css" rel="stylesheet">
@stop

@section('content')

    <div class="navigation-header container">
        <img src="{{ image('frame_me_blue.png') }}" class="banner">
    </div>

    <div class="tutorial-container container bordered">
        <h1>List of tutorials</h1>
        {{--<hr>--}}

        <div class="button-container">
            <span class="btn">Create</span>
        </div>

        <table class="tutorial-overview frameme-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Pages</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($tutorials as $key => $tutorial)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $tutorial->get('name') }}</td>
                    <td>{{ $tutorial->get('description') }}</td>
                    <td>{{ $tutorial->get('pages_count') }}</td>
                    <td>
                        <div class="table-btn-container">
                            <span class="btn disabled"><span class="btn-icon ti-plus"></span></span>
                            <a href="{{ url('use_case_details', [$tutorial->get('hash')]) }}" class="btn"><span class="btn-icon ti-pencil"></span></a>
                            <span class="btn disabled"><span class="btn-icon ti-trash"></span></span>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop