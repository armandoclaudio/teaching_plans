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

    @media print {
       #nav {
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
        <div id="nav">
            <plans-nav app_name="PLANS" home_path="/">
                <img slot="logo" src="">
                @if(Auth::check())
                    <nav-item link="{{ route('standards.index') }}">STANDARDS</nav-item>
                    @if(Route::currentRouteName() == 'plans.show')
                        <nav-item link="javascript:window.print();">PRINT</nav-item>
                    @endif
                    <nav-item link="javascript:document.getElementById('logout-form').submit();">
                        <p>
                            LOGOUT
                        </p>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </nav-item>
                @else
                    <nav-item link="/register">REGISTER</nav-item>
                    <nav-item link="/login">LOGIN</nav-item>
                @endif
            </plans-nav>
        </div>
    @yield('content')

    <div id="global-vue">
        @if(Session::has('message'))
            <flash-message>{{ Session::get('message') }}</flash-message>
        @endif
    </div>

    <script src="/js/app.js"></script>

</body>
</html>