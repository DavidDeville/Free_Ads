<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @if(auth()->user())
                    <form id="search_title-form" action="{{ route('search_by_title') }}" method="post">
                        @csrf
                        <input type="text" name="title" placeholder="Recherche par titre">
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
    
                    <form id="search_date-form" action="{{ route('search_by_date') }}" method="post">
                            @csrf
                            <label for="date-select">Par date:</label>
                            <select name="order" id="order-select">
                                <option value="">--Choisissez votre tri--</option>
                                <option value="asc">Croissant</option>
                                <option value="desc">Décroissant</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>

                    <form id="search_price-form" action="{{ route('search_by_price') }}" method="post">
                            @csrf
                            <label for="price-select">Par prix:</label>
                            <select name="price" id="order-select">
                                <option value="">--Choisissez votre tri--</option>
                                <option value="asc">Croissant</option>
                                <option value="desc">Décroissant</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                    @endif
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('profil', ['id' => Auth::user()]) }}">
                                        {{ __('Mon compte') }}
                                    </a>
                                    @if(auth()->user())
                                    <a class="dropdown-item" href="{{ route('annonce')}}">
                                            {{ __('Publier une annonce') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('display_annonces')}}">
                                        {{ __('Voir les annonces') }}
                                    </a>
                                    @endif
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
