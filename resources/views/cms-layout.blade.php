<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>@yield('title')</title>   
        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/reset.css') }}">
        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/cms/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/cms/select2.min.css') }}">
        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/cms/select2-override.css') }}">

        <script src="{{ asset('js/cms/app.js')}}"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>   
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    </head>   
    <body>

        @if ($message = Session::get('success'))
            <div id="alert-message">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>{{ $message }}</strong>
            </div>
        @endif

        {{-- <a href="{{ route('cms.homepage') }}" id="logo">MyRecordBox <span>CMS</span></a> --}}

        {{-- <section id="appbar">
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
        </section> --}}
  
        <div class="icon-bar">
            <a href="{{ route('cms.homepage') }}" id="logo"><div>MyRecordBox <strong>CMS</strong></div></a>
            
            <a href="{{ route('cms.homepage') }}" class="{{ (request()->segments()['1'] == 'home') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>              
            </a> 

            <a href="#" class="{{ (request()->segments()['1'] == 'basedata') ? 'active' : '' }}">
                <i class="fa fa-database"></i>
                <span>Base Data</span>
            </a> 

            <a href="#">
                <i class="fas fa-chart-pie"></i>
                <span>Reports</span>
            </a> 

            <a href="#">
                <i class="fas fa-power-off"></i>
                <span>Logout</span>
            </a>
        </div>
     


        <section id="page-header">
            <div class="wrapper">
                @yield('page-header')
                <section id="breadcrumbs">                    
                    <ul class="breadcrumb">
                        @yield('breadcrums')
                    </ul>
                </section>
            </div>
	    </section>
        
        <div class="wrapper">
            @yield('content')
            <br class="clear" />
        </div>
        
        <footer id="page-footer">
            <div class="wrapper">  
                <section id="base-data">
                    <ul>
                        <li><a href="{{ route('cms.basedata.albums.index') }}">Albums</a></li>
                        <li><a href="{{ route('cms.basedata.artists.index') }}">Artists</a></li>
                        <li><a href="{{ route('cms.basedata.formats.index') }}">Formats</a></li>
                        <li><a href="{{ route('cms.basedata.genres.index') }}">Genres</a></li>
                        <li><a href="{{ route('cms.basedata.labels.index') }}">Labels</a></li>
                        <li><a href="{{ route('cms.basedata.playlists.index') }}">Playlists</a></li>
                        <li><a href="{{ route('cms.basedata.tags.index') }}">Tags</a></li>
                        <li><a href="{{ route('cms.basedata.tracks.index') }}">Tracks</a></li>				
                    </ul>
                </section>
            </div>
        </footer>

        @yield('javascript')                 
    </body>
</html>