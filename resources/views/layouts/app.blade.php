<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>8commerce | @yield('title')</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/important/8commerce-icon.png') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    <link href="{{ asset('css/presence.css') }}" rel="stylesheet">
    <link href="{{ asset('css/task.css') }}" rel="stylesheet">
    <link href="{{ asset('css/project.css') }}" rel="stylesheet">
    <link href="{{ asset('css/survey.css') }}" rel="stylesheet">
    <link href="{{ asset('css/performance-detail.css') }}" rel="stylesheet">
    <link href="{{ asset('css/homeProgrammer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/homeClient.css') }}" rel="stylesheet">
    <link href="{{ asset('css/circular-progressbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/themify/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/aos/aos.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/bxslider/jquery.bxslider.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900" rel="stylesheet">
    <script src="https://use.fontawesome.com/874dbadbd7.js"></script>
    
    @yield('css')

    <script src="{{ asset('js/d3.v3.min.js') }}"></script>

    <script>document.write('<script src="http://' + (location.host || '${1:localhost}').split(':')[0] + ':${2:35729}/livereload.js?snipver=1"></' + 'script>')</script>
</head>
<body>
    
    {{-- NAVBAR --}}
    <div id="navbar">

        <div class="navbar-menu">

            <div class="navbar-dropdown dropdown" id="markAsRead" onclick="markNotificationAsRead()">
                <button class="dropdown-toggle navbar-dropdown-btn notif" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <a href="#" class="hamburger-btn"><span class="ti-bell"></span></a>
                    @if ( count(auth()->user()->unreadNotifications) > 0 )
                        <div class="red-dot">&nbsp;</div>
                    @endif
                </button>

                <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenu1">
                    @forelse (auth()->user()->unreadNotifications as $notification)
                        {{-- @include('notification_ ' .snake_case(class_basename($notification->type))) --}}
                        <li class="list-notification">
                            <a href="/tasks/{{ $notification->data['comment']['commentable_id'] }}"><img src="{{ $notification->data['user']['avatar'] }}" alt="" style="width: 50px;"> {{ $notification->data['user']['name'] }} replied</a>
                        </li>
                        @empty
                        <li class="list-notification">
                            <a href="#" style="padding: 10px;">No notification</a>
                        </li>
                    @endforelse
                </ul>
            </div>
            {{-- <a href="#" class="hamburger-btn"><span class="ti-bell"></span></a> --}}

            <div class="navbar-dropdown dropdown">

                <button class="dropdown-toggle navbar-dropdown-btn" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <img src="{{ asset(Auth::user()->avatar) }}" alt="avatar" class="navbar-avatar">
                    <span class="navbar-avatar-name">{{ Auth::user()->name }} &nbsp; </span> <span class="ti-angle-down"></span>
                </button>

                <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenu1">
                    <li>
                        <a href="/users/{{Auth::user()->id}}"><span class="ti-settings"></span>&nbsp; Account Setting</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            <span class="ti-power-off"></span>&nbsp; Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>

            </div>
        </div>

        <a href="{{ url('/home') }}">
            <img src="{{ asset('images/important/8commerce.png') }}" alt="logo" class="img-logo">
                        {{-- config('app.name', 'Laravel') --}}
        </a>

    </div> {{-- end navbar --}}
    
    @if(Auth::user()->role_id == 1)
        <div id="secondary-nav">
            <ul class="secondary-navbar">
                <li class="secondary-navbar-list"><a href="{{ url('/home') }}" class="list-group-item"><span class="ti-home"></span>&nbsp; Home</a></li>
                <li class="secondary-navbar-list"><a href="{{ route('companies.index') }}" class="list-group-item"><span class="ti-crown"></span>&nbsp; Companies</a></li>
                <li class="secondary-navbar-list"><a href="{{ route('projects.index') }}" class="list-group-item"><span class="ti-briefcase"></span>&nbsp; Projects</a></li>
                {{-- <li class="secondary-navbar-list"><a href="{{ route('tasks.index') }}" class="list-group-item"><span class="ti-check-box"></span>&nbsp; Tasks</a></li> --}}
                <li class="secondary-navbar-list"><a href="{{ route('presences.index') }}" class="list-group-item"><span class="ti-id-badge"></span>&nbsp; Presences</a></li>
                <li class="secondary-navbar-list"><a href="{{ route('users.index') }}" class="list-group-item"><span class="ti-user"></span>&nbsp; Users</a></li>
                <li class="secondary-navbar-list"><a href="{{ route('surveys.index') }}" class="list-group-item"><span class="ti-marker"></span>&nbsp; Surveys</a></li>
                {{-- <li class="secondary-navbar-list"><a href="{{ route('reviews.index') }}" class="list-group-item"><span class="ti-comments"></span>&nbsp; Reviews</a></li> --}}
            </ul>
        </div>
    @else
        <div id="secondary-nav">
            <ul class="secondary-navbar">
                <li class="secondary-navbar-list"><a href="{{ url('/home') }}" class="list-group-item"><span class="ti-home"></span>&nbsp; Home</a></li>
            </ul>
        </div>
    @endif

    <div id="main-content">
        <div class="main-content">

            <div class="container">
                {{-- @include('partials.success')
                @include('partials.errors') --}}
            </div>

            @yield('content')
        </div>
    </div>

    <div id="app" style="display: none;">
        <nav class="navbar-default navbar-static-top navbar navbar-custom">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else

                            <li><a href="{{ route('companies.index') }}"><span class="ti-home"></span>&nbsp; My Companies</a></li>
                            <li><a href="{{ route('projects.index') }}"><span class="ti-briefcase"></span>&nbsp; Projects</a></li>
                            <li><a href="{{ route('tasks.index') }}"><span class="ti-check-box"></span>&nbsp; Tasks</a></li>

                            {{-- Admin Menu --}}
                            @if(Auth::user()->role_id == 1)
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                        <span class="ti-desktop"></span>&nbsp; Admin <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ route('projects.index') }}"><span class="ti-briefcase"></span>&nbsp; All Projects</a></li>
                                        <li><a href="{{ route('users.index') }}"><span class="ti-user"></span>&nbsp; All Users</a></li>
                                        <li><a href="{{ route('tasks.index') }}"><span class="ti-check-box"></span>&nbsp; All Tasks</a></li>
                                        <li><a href="{{ route('companies.index') }}"><span class="ti-home"></span>&nbsp; All Companies</a></li>
                                        <li><a href="{{ route('roles.index') }}"><span class="ti-id-badge"></span>&nbsp; All Roles</a></li> 
                                    </ul>
                                </li>
                            @endif

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu ">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        
        {{-- flash message --}}
        {{-- <div class="container">
            @include('partials.success')
            @include('partials.errors')
        </div> --}}

        {{-- @yield('content') --}}

    </div>

    {{-- SIDEBAR --}}
    {{-- <div id="wrapper">
        <div id="sidebar-wrapper">
            <aside id="sidebar">
                <ul id="sidemenu" class="sidebar-nav">
                    <li>
                        <a href="#">
                            <span class="sidebar-icon"><i class="fa fa-dashboard"></i></span>
                            <span class="sidebar-title">Home</span>
                        </a>
                    </li>
                    <li>
                        <a class="accordion-toggle collapsed toggle-switch" data-toggle="collapse" href="#submenu-2">
                            <span class="sidebar-icon"><i class="fa fa-users"></i></span>
                            <span class="sidebar-title">Management</span>
                            <b class="caret"></b>
                        </a>
                        <ul id="submenu-2" class="panel-collapse collapse panel-switch" role="menu">
                            <li><a href="#"><i class="fa fa-caret-right"></i>Users</a></li>
                            <li><a href="#"><i class="fa fa-caret-right"></i>Roles</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="accordion-toggle collapsed toggle-switch" data-toggle="collapse" href="#submenu-3">
                            <span class="sidebar-icon"><i class="fa fa-newspaper-o"></i></span>
                            <span class="sidebar-title">Blog</span>
                            <b class="caret"></b>
                        </a>
                        <ul id="submenu-3" class="panel-collapse collapse panel-switch" role="menu">
                            <li><a href="#"><i class="fa fa-caret-right"></i>Posts</a></li>
                            <li><a href="#"><i class="fa fa-caret-right"></i>Comments</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <span class="sidebar-icon"><i class="fa fa-database"></i></span>
                            <span class="sidebar-title">Data</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="sidebar-icon"><i class="fa fa-terminal"></i></span>
                            <span class="sidebar-title">Console</span>
                        </a>
                    </li>
                </ul>
            </aside>            
        </div>
        <main id="page-content-wrapper" role="main">

            <div class="container">
                @include('partials.success')
                @include('partials.errors')
            </div>

            @yield('content')
        </main>
    </div> --}} {{-- END SIDEBAR --}}

    {{-- <div id="container-test">
        <div id="sidebar-main">
            <div id="sidebar-wrapper">
            <aside id="sidebar">
                <ul id="sidemenu" class="sidebar-nav">
                    <li>
                        <a href="#">
                            <span class="sidebar-icon"><i class="fa fa-dashboard"></i></span>
                            <span class="sidebar-title">Home</span>
                        </a>
                    </li>
                    <li>
                        <a class="accordion-toggle collapsed toggle-switch" data-toggle="collapse" href="#submenu-2">
                            <span class="sidebar-icon"><i class="fa fa-users"></i></span>
                            <span class="sidebar-title">Management</span>
                            <b class="caret"></b>
                        </a>
                        <ul id="submenu-2" class="panel-collapse collapse panel-switch" role="menu">
                            <li><a href="#"><i class="fa fa-caret-right"></i>Users</a></li>
                            <li><a href="#"><i class="fa fa-caret-right"></i>Roles</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="accordion-toggle collapsed toggle-switch" data-toggle="collapse" href="#submenu-3">
                            <span class="sidebar-icon"><i class="fa fa-newspaper-o"></i></span>
                            <span class="sidebar-title">Blog</span>
                            <b class="caret"></b>
                        </a>
                        <ul id="submenu-3" class="panel-collapse collapse panel-switch" role="menu">
                            <li><a href="#"><i class="fa fa-caret-right"></i>Posts</a></li>
                            <li><a href="#"><i class="fa fa-caret-right"></i>Comments</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <span class="sidebar-icon"><i class="fa fa-database"></i></span>
                            <span class="sidebar-title">Data</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="sidebar-icon"><i class="fa fa-terminal"></i></span>
                            <span class="sidebar-title">Console</span>
                        </a>
                    </li>
                </ul>
            </aside>            
        </div>
        </div>
        <div id="main-content">
            
        </div>
    </div> --}}

    

    {{-- jQuery --}}
    <script src="{{ asset('assets/jquery/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/jquery/chart-271.min.js') }}"></script>
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/aos/aos.js') }}"></script>

    <!-- Include this after the sweet alert js file -->
    @include('sweet::alert')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function eximForm(){
            $('#modal-exim').modal('show');
            $('#modal-exim form')[0].reset();
        }

        function markNotificationAsRead() {
            $.get('/markAsRead');
        }

        $(document).ready(function() {
           AOS.init();
        });

    </script>

    <script src="{{ asset('assets/jquery/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('assets/bxslider/jquery.bxslider.js') }}"></script>
    <link href="{{ asset('css/bxslider-custom.css') }}" rel="stylesheet">

    @yield('javascript')

    <script>document.write('<script src="http://' + (location.host || '${1:localhost}').split(':')[0] + ':${2:35729}/livereload.js?snipver=1"></' + 'script>')</script>


</body>
</html>
