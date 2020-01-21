<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Пример на bootstrap 4: Макет jumbotron с навигационной панели и базовая система разметки.">

    <title>ТЗ</title>

    <link href="/css/bootstrap.css" rel="stylesheet">
    <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon.ico">
    <link href="/css/carousel.css" rel="stylesheet">

</head>
<body>



<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="{!! route('home') !!}">{!! __('BlogTZ') !!}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                @isset($topNav)
                    @foreach($topNav as $nav)
                        <li class="{!! $nav->class_li !!}">
                            <a class="{!! $nav->class_a !!}" href="{!! $nav->url !!}">{!! $nav->head !!}</a>
                        </li>
                    @endforeach
                @endisset
            </ul>
            <ul class="navbar-nav">
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
        </div>
    </nav>
</header>

<main role="main">
    @yield('content')
    <!-- FOOTER -->
    <footer class="container">
        <p class="float-right"></p>
        <p>&copy; {!! __('Test company') !!}</p>
    </footer>
</main>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="/js/bootstrap.js"></script>
 </html>