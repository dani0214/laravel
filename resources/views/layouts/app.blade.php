<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUIyJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>PC-Shop</title>
</head>
<body>
    <div id="app">
        <nav class="navbar">
            <div class="container-fluid">
                <div class="row">
                    <!-- Right Side Of Navbar -->
                        <!-- Authentication Links -->
                        @guest
                                @if (Route::has('login'))
                                    <div class="col-md-1">
                                        <h5><a class="nav-link" href="{{ route('login') }}">
                                            <i class="fa fa-sign-in">
                                                {{ __('Iniciar Sesion') }}
                                            </i>
                                        </a></h5>
                                    </div>
                                @endif
                                @if (Route::has('register'))
                                    <div class="colcol-md-1">
                                    <h5><a class="nav-link" href="{{ route('register') }}">
                                            <i class="fa fa-pencil-square-o">
                                                {{ __('Crear Cuenta') }}
                                            </i>
                                        </a></h5>
                                    </div>
                                @endif   
                        @else
                            <div>
                                <div class="" id="navegacion">
                                    <div class="col-md-8">
                                        <div class="btn-group" role="group" id="btn_nav">
                                            <a href="/">
                                                <button class="btn">
                                                    <i class="fa fa-home">
                                                        Inicio
                                                    </i>
                                                </button>
                                            </a>
                                            <a href="{{route('cart.checkout')}}" id="btn_nav">
                                                <button class="btn">
                                                    <i class="fa fa-shopping-cart">
                                                        <span>{{count(Cart::getContent())}}</span>
                                                    </i>
                                                </button>
                                            </a>
                                            <a href="{{ route('pedidos', Auth::user()->id) }}" id="btn_nav">
                                                <button class="btn">
                                                    <i class="fa fa-dropbox">
                                                        Mis Pedidos
                                                    </i>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        
                                        <a href="/datos_usuario" role="button" id="btn_nav">
                                            <button class="btn">
                                                <i class="fa fa-user-circle">
                                                    {{ ('Mis datos') }}
                                                </i>
                                            </button>
                                        </a>

                                        <a class="dropdown-item" href="{{ route('logout') }} "
                                            onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();" id="btn_nav">
                                            <button class="btn">
                                                <i class="fa fa-sign-out">
                                                    {{ __('Cerrar sesion') }}
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                </form>
                                                </i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endguest
                </div>
            </div>
        </nav>
        <main class="py-4">
            @include('menu')
            @include('footer')
            @yield('content')
            @yield('footer')
        </main>
    </div>
</body>
</html>
