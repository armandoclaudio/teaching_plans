<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Plans UBD</title>

    <link rel="stylesheet" href="/css/app.css">

    <style>
    .indented {
        padding-left:20px;
    }

    .align-bottom {
        vertical-align: bottom;
    }

    @media print {
       .navbar, .no-print {
            display:none;
       }
    }

    .avoid-break-inside {
        -webkit-column-break-inside: avoid;
        page-break-inside: avoid;
        break-inside: avoid;
    }
    </style>
</head>
<body>
    <div id="app">
        @include('nav')
        @if(Session::has('message'))
            <flash-message>{{ Session::get('message') }}</flash-message>
        @endif
    </div>

    @yield('content')

    <script src="/js/app.js"></script>

</body>
</html>