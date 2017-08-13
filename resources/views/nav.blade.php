<nav class="navbar has-shadow">
    <div class="navbar-brand">

        <a class="navbar-item" href="/">
            PLANS
        </a>

        <div class="navbar-burger burger" :class="{ 'is-active' : is_burguer_open }" @click="toggleBurguer">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="navbar-menu" :class="{ 'is-active' : is_burguer_open }">
        <div class="navbar-start">
            @if(Auth::check())
                @if(Route::currentRouteName() == 'plans.show')
                    <a class="navbar-item " href="javascript:window.print();">PRINT</a>
                @endif
                <a class="navbar-item " href="{{ route('standards.index') }}">STANDARDS</a>
            @endif
        </div>

        <div class="navbar-end">
            @if(Auth::check())
                <a class="navbar-item " href="{{ route('profile.edit') }}">PROFILE</a>
                <a class="navbar-item " href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <p>LOGOUT</p>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </a>
            @else
                <a class="navbar-item " href="{{ route('login') }}">LOGIN</a>
                <a class="navbar-item " href="{{ route('register') }}">REGISTER</a>
            @endif
        </div>
    </div>
</nav>