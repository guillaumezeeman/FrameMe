<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ image('favicon.ico') }}">

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/base.css') }}" type="text/css" rel="stylesheet">

    @yield('css')

    <title>FrameMe</title>
</head>
<body>
<div class="content">

@yield('content')

    <!-- javascript -->
    <script>
        var base_url     = "{{ rtrim(url('homepage'), "/") }}";
        var current_page = "{{ $current_page or 'home' }}";
    </script>
@yield('js')

</div>
</body>
</html>