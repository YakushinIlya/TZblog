<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Пример на bootstrap 4: Базовая панель администратора с фиксированной боковой панелью и навигационной панелью. Версия v4.0.0">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Панель администратора | Dashboard Template for Bootstrap (BS 4.0)</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{!! route('home') !!}">{!! __('BlogTZ') !!}</a>
    <ul class="navbar-nav mr-auto">
        @isset($topNav)
            @foreach($topNav as $nav)
                <li class="{!! $nav->class_li !!}">
                    <a class="{!! $nav->class_a !!}" href="{!! $nav->url !!}">{!! $nav->head !!}</a>
                </li>
            @endforeach
        @endisset
    </ul>
    <ul class="navbar-nav user-nav">
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('profile') }}">
                        {{ __('Профиль') }}
                    </a>
                    @if(Auth::user()->role>0)
                        <a class="dropdown-item" href="{{ route('admin') }}">
                            {{ __('AdminPanel') }}
                        </a>
                    @endif
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Выход') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    @isset($admNav)
                        @foreach($admNav as $nav)
                            <li class="{!! $nav->class_li !!}">
                                <a class="{!! $nav->class_a !!}" href="{!! $nav->url !!}">{!! $nav->head !!}</a>
                            </li>
                        @endforeach
                    @endisset
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="/js/bootstrap.js"></script>

</body>
</html>