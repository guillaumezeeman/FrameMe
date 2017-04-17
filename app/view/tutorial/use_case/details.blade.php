@extends('base')

@section('css')
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/themify-icons.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/use_case.css') }}" type="text/css" rel="stylesheet">
@stop

@section('js')
    <script type="text/javascript" src="{{ asset("javascript/app.js") }}"></script>
@stop

@section('content')

    <div class="navigation-header fade-in fade-out container">
        @include('tutorial.partial.content_banner', ["navigation_left" => "use-case"])
    </div>

    <div class="tutorial-container container bordered">
        <div class="row tutorial-description">
            <table>
                <tbody>
                <tr>
                    <td class="description-title">Name:</td>
                    <td class="description-value">{{ $tutorial->get('name') }}</td>
                </tr>
                <tr>
                    <td class="description-title">Description:</td>
                    <td class="description-value">{{ $tutorial->get('description') }}</td>
                </tr>
                <tr>
                    <td class="description-title">Number of pages:</td>
                    <td class="description-value">{{ $tutorial->get('pages_count') }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <table class="pages-overview frameme-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Title</th>
                <th>Description</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($tutorial->get('pages') as $key => $page)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $page->get('name') }}</td>
                    <td>{{ $page->get('title') }}</td>
                    <td>{{ $page->get('description') }}</td>
                    <td>
                        <div class="table-btn-container">
                            <span class="btn disabled"><span class="btn-icon ti-pencil"></span></span>
                            <span class="btn disabled"><span class="btn-icon ti-trash"></span></span>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop