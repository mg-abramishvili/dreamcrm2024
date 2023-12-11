<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>DreamCRM</title>

        @vite('resources/css/app.css')
    </head>
    <body @auth class="{{ session('theme') ? session('theme') . '-theme' : 'light-theme'  }}" @endauth>
        @auth
            <div id="app"></div>
        @endauth

        @guest
            @yield('content')
        @endguest

        @if(Route::currentRouteName() != 'login')
            @vite('resources/js/app.js')
        @endif
    </body>
</html>
