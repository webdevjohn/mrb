<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>{{ config('app.name') }} - {{ $title }}</title>
        
        <!-- Styles -->   
        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/reset.css') }}">
        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/cms/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/cms/select2.min.css') }}">
        <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/cms/select2-override.css') }}">

        <!-- Javascript -->
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

        <div id="logo-con">
            <a href="{{ route('cms.dashboard') }}" id="logo"><div>MyRecordBox <strong>CMS</strong></div></a>
        </div>
        
        <div class="icon-bar">                    
            <a href="{{ route('cms.dashboard') }}" class="{{ (request()->segments()['1'] == 'dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>              
            </a> 

            <a href="{{ route('cms.basedata.index') }}" class="{{ (request()->segments()['1'] == 'basedata') ? 'active' : '' }}">
                <i class="fa fa-database"></i>
                <span>Base Data</span>
            </a> 

            <a href="{{ route('cms.reports.index') }}" class="{{ (request()->segments()['1'] == 'reports') ? 'active' : '' }}">
                <i class="fas fa-chart-pie"></i>
                <span>Reports</span>
            </a> 

            <a href="javascript:{}" onclick="document.getElementById('logout-form').submit();">
                <i class="fas fa-power-off"></i>
                <span>Logout</span>
            </a>
        </div>
     
        <section id="page-header">
            <div class="wrapper">
                
                <h1>{{ $pageHeader }}</h1>

                <section id="breadcrumbs">                    
                    <ul class="breadcrumb">
                       {{ $breadcrumbs }}
                    </ul>
                </section>                
            </div>
	    </section>
        
        <div class="wrapper">
            {{ $slot }}
            <br class="clear" />
        </div>
        
        <footer id="page-footer">
            <div class="wrapper">  
                <a href="{{ route('cms.dashboard') }}" class="logo"><div>MyRecordBox <strong>CMS (Admin)</strong></div></a>
            </div>
        </footer>

        <form role="form" method="POST" action="{{ route('logout') }}" id="logout-form">
            {{ csrf_field() }}
            <button type="submit">
                Logout: <strong>{{ Auth::user()->name }}</strong>
            </button>
        </form>

        {{ $javascript ?? '' }}           
    </body>
</html>