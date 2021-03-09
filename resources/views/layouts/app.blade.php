<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>@yield('title')</title>

        <!-- Styles -->
        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/reset.css') }}">
        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        {{ $slot }}
        <form method="POST" action="{{ route('logout') }}" id="frmLogout">
            @csrf
            <button type="submit" form="frmLogout" value="Logout">Logout</button>
        </form>
    </body>
</html>
