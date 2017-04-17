<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') </title>

    <!-- Styles -->
    {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css', [
        'crossorigin' => 'anonymous',
        'integrity' => 'sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+',
    ]) }}

    {{ Html::style('https://fonts.googleapis.com/css?family=Lato:100,300,400,700') }}
    <!-- Styles -->
    {{ Html::style('css/app.css') }}
    {{ Html::style('css/all.css') }}

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">
                            {{ trans('settings.text.framgia_elearning_system') }}
                        </span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ action('User\HomeController@index') }}">
                        {{ trans('settings.text.framgia_elearning_system') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @yield('nabar')
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->

                        @if (Auth::guest())
                            <li><a href="{{ action('Auth\LoginController@showLoginForm') }}">
                                {{ trans('settings.text.login') }}
                            </a></li>
                            <li><a href="{{ action('Auth\RegisterController@showRegistrationForm') }}">
                                {{ trans('settings.text.register') }}
                            </a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ action('Auth\LoginController@logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ trans('settings.text.logout') }}
                                        </a>

                                        {{ Form::open([
                                            'id' => 'logout-form',
                                            'action' => 'Auth\LoginController@logout',
                                            'method' => 'POST',
                                            'style' => 'display:none',
                                        ]) }}
                                        {{ Form::close() }}
                                    </li>
                                    @if (Auth::user()->is_admin == 1)
                                    <li>
                                        <a href="{{ action('Admin\HomeAdminController@index') }}">
                                            {{ trans('settings.text.page_admin') }}
                                        </a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="{{ action('User\UserController@showProfile') }}">
                                            {{ trans('settings.text.profile') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    {{ Html::script('js/app.js') }}
    {{ Html::script('js/style.js') }}
</body>
</html>
