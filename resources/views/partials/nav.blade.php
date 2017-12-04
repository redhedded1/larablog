<nav class="cbp-spmenu cbp-spmenu-horizontal cbp-spmenu-top" id="cbp-spmenu-s3">
    <img class="logo" src="/img/logo.png" alt="">
    <a href="/"><i class="fa fa-home fa-2x" aria-hidden="true"></i></a>
    <a href="/about"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i></a>
    <a href="/contact"><i class="fa fa-address-book-o fa-2x" aria-hidden="true"></i></a>
    @if (Auth::guest())
        @if(route('login') !== Request::url())
            <a href="{{ url('/login') }}"><i class="fa fa-sign-in fa-2x" aria-hidden="true"></i></a>
        @endif
    @else
        @if(route('dashboard') !== Request::url())
            <a href="{{ url('/home') }}"><i class="fa fa-th-large fa-2x" aria-hidden="true"></i></a>
        @endif
            <a href="{{ url('/logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-mobile').submit();">
                <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
            </a>
            <form id="logout-mobile" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
    @endif
</nav>

{{--<div class="container-fluid">--}}
    <button type="button" id="mobileMenuToggle">
        Menu <i class="fa fa-bars"></i>
    </button>
{{--</div>--}}

<nav id="bigNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header page-scroll">

            <!-- Collapsed Hamburger -->
            {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">--}}
                {{--<span class="sr-only">Toggle Navigation</span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
            {{--</button>--}}
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ url('/articles') }}">
                    {{ config('app.name', 'Larablog') }}
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="/about">About</a>
                    </li>

                    <li>{!! link_to_action('ArticlesController@show', 'Newest Post: ' . $latest->title, [$latest->id]) !!}</li>

                    <li>
                        <a href="/contact">Contact</a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    @if(route('login') !== Request::url())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    @endif
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                @if(route('dashboard') !== Request::url())
                                    <a href="{{ url('/home') }}">Dashboard</a>
                            @endif
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>