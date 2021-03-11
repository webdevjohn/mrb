<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>@yield('title')</title>   
        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/reset.css') }}">
        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/cms/app.css') }}">

        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/cms/select2.min.css') }}">
        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/cms/select2-override.css') }}">

        <script src="{{ asset('js/cms/app.js')}}"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>   
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    </head>   
    <body>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <a href="{{ route('cms.homepage') }}" id="logo">MyRecordBox <span>CMS</span></a>

        <section id="appbar">
            <ul>
                <li><a href="">Manage Base Data</a></li>
                <li><a href="">Tools</a></li>
                <li><a href="">Reports</a></li>
            </ul>
            @if (Auth::check()) 
                <form role="form" method="POST" action="{{ route('logout') }}" class="logout-form">
                   {{ csrf_field() }}
                    <button type="submit">
                        Logout: <strong>{{ Auth::user()->name }}</strong>
                    </button>
                </form>
            @endif
        </section>

        <section id="breadcrums">
            <ul>
                @yield('breadcrums')
            </ul>
        </section>
        
        <div class="wrapper">
            @yield('content')
            <br class="clear" />
        </div>
        
        <footer id="page-footer">
            <div class="wrapper">  
        
            </div>
        </footer>

        @yield('javascript')                 
    </body>
</html>