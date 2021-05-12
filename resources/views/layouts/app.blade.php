<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>{{ config('app.name') }} - {{ $title }}</title>

        <!-- Styles -->
        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/reset.css') }}">
        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- media player styles -->
        <link media="screen" type="text/css" rel="stylesheet" href="{{ asset('css/360player.css') }}">
        <link media="screen" type="text/css" rel="stylesheet" href="{{ asset('css/360player-visualization.css') }}">

        <!-- Javascript -->
        <script src="{{ asset('js/app.js')}}"></script>  
        <script src="{{ asset('js/berniecode-animator.js')}}"></script>  
        <script src="{{ asset('js/soundmanager2.js')}}"></script>  
        <script src="{{ asset('js/360player.js')}}"></script> 
    </head>
    <body>
  
 

        {{ $slot }}
        <form method="POST" action="{{ route('logout') }}" id="frmLogout">
            @csrf
            <button type="submit" form="frmLogout" value="Logout">Logout</button>
        </form>
    </body>
</html>
