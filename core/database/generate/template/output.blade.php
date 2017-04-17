<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ image('favicon.ico') }}">

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/bin/generate/base.css') }}" type="text/css" rel="stylesheet">

    <title>iValue</title>
</head>
<body>
<div class="main-container container">

    <h1 class="script-name">Model generator</h1>
    <div class="content">

        <div class="row description">
            <table>
                <tbody>
                <tr>
                    <td class="description-title">Database name:</td>
                    <td class="description-value">{{ $schema }}</td>
                </tr>
                <tr>
                    <td class="description-title">Number of models:</td>
                    <td class="description-value">{{ count($models) }}</td>
                </tr>
                <tr>
                    <td class="description-title">Number of new models:</td>
                    <td class="description-value">{{ $new_models }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        @foreach($models as $key => $model)
            <div class="table row">
                <div class="table-header">
                    <div class="title">{{ $model["class_name"] }} : {{ $model["name"] }}</div>
                    <div class="button-group">
                        <i class="close-table-btn fa fa-minus"></i>
                        <i class="close-table-btn fa fa-times"></i>
                    </div>
                </div>
                <div class="columns">

                    <table class="column-table">
                        <thead>
                        <th><div>Column</div></th>
                        <th><div>Type</div></th>
                        <th><div>Default</div></th>
                        <th><div>Nullable</div></th>
                        <th><div>Extra</div></th>
                        </thead>
                        <tbody>
                        @foreach($model["columns"] as $key => $column)
                            <tr>
                                <td>{{ $column["column_name"] }}</td>
                                <td>{{ $column["data_type"] }}</td>
                                <td>{{ $column["default"] }}</td>
                                <td>{{ ucfirst($column["is_nullable"]) }}</td>
                                <td>{{ $column["extra"] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>

</div>
</body>
</html>