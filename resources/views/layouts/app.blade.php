<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token"
        content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"
        defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch"
        href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}"
        rel="stylesheet">
</head>

<body>
    <div id="app" class="h-full flex flex-col">
        <nav class="flex-no-grow flex items-center justify-between flex-wrap bg-teal-500 px-6 py-2">
            <h1 class="flex items-center flex-shrink-0 text-white mr-6">
                <svg class="fill-current h-8 w-8 mr-2"
                    width="54"
                    height="54"
                    viewBox="0 0 54 54"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z" />
                </svg>
                <span class="font-semibold text-xl tracking-tight">{{ config('app.name', 'Laravel') }}</span>
            </h1>
            <div class="block lg:hidden">
                <button
                    class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
                    <svg class="fill-current h-3 w-3"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>
            <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
                <div class="text-sm lg:flex-grow lg:flex lg:justify-center">
                    <a href="{{ route('projects.index') }}"
                        class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                        Projects
                    </a>
                </div>
                <div>
                    <!-- Authentication Links -->
                    @guest
                    <div class="flex items-center">

                        <a class="nav-btn"
                        href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                        <a class="nav-btn ml-4"
                        href="{{ route('register') }}">{{ __('Register') }}</a>
                    </div>
                    @endif
                    @else
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown flex items-center ">
                            <button id="navbarDropdown"
                                class="nav-link dropdown-toggle text-white mx-4"
                                role="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-right"
                                aria-labelledby="navbarDropdown">
                                <a class="dropdown-item nav-btn"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form"
                                    action="{{ route('logout') }}"
                                    method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="py-4 flex-1 bg-gray-100">
            @yield('content')
        </div>
    </div>
</body>

</html>
